<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClubRequest;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Club;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClubsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Club::with(['users'])->select(sprintf('%s.*', (new Club)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'club_show';
                $editGate      = 'club_edit';
                $deleteGate    = 'club_delete';
                $crudRoutePart = 'clubs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('indoor_courts', function ($row) {
                return $row->indoor_courts ? $row->indoor_courts : "";
            });
            $table->editColumn('outdor_courts', function ($row) {
                return $row->outdor_courts ? $row->outdor_courts : "";
            });
            $table->editColumn('user', function ($row) {
                $labels = [];

                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->email);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.clubs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('club_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('email', 'id');

        return view('admin.clubs.create', compact('users'));
    }

    public function store(StoreClubRequest $request)
    {
        $club = Club::create($request->all());
        $club->users()->sync($request->input('users', []));

        return redirect()->route('admin.clubs.index');
    }

    public function edit(Club $club)
    {
        abort_if(Gate::denies('club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('email', 'id');

        $club->load('users');

        return view('admin.clubs.edit', compact('users', 'club'));
    }

    public function update(UpdateClubRequest $request, Club $club)
    {
        $club->update($request->all());
        $club->users()->sync($request->input('users', []));

        return redirect()->route('admin.clubs.index');
    }

    public function show(Club $club)
    {
        abort_if(Gate::denies('club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->load('users', 'clubTournaments');

        return view('admin.clubs.show', compact('club'));
    }

    public function destroy(Club $club)
    {
        abort_if(Gate::denies('club_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->delete();

        return back();
    }

    public function massDestroy(MassDestroyClubRequest $request)
    {
        Club::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
