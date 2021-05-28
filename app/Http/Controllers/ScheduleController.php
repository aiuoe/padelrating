<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('id'))
            return Schedule::where('player_id', $request->input('id'))->get();
        else
        {
            $auth_id = Player::where('user_id', auth()->user()->id)->first()->id;
            return Schedule::where('player_id', $auth_id)->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $start = Carbon::parse($data['start']);
        $end = Carbon::parse($data['end']);

        $player_id = Player::where('user_id', auth()->user()->id)->first()->id;

        $count = Schedule::where([
            ['player_id', '=', $player_id],
            ['start', '=', $data['start']],
        ])->count();

        if( $count == 0 )
        {
            $schedule = Schedule::create([
                'player_id'       => $player_id,
                'start'         => $start->format('Y-m-d H:i:s'),
                'end'           => $end ->format('Y-m-d H:i:s')
            ]);

            return response()->json(['success'=>'Registro Agregado']);
        }else{
            return response()->json(['error'=> 'Deberias Eliminar']);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule , Request $request)
    {

        $data = $request->all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Schedule $schedule)
    {
        $data = $request->all();
        $consulta = Schedule::find($data['id']);
        $consulta->delete();
        return response()->json(['success'=>'Registro Eliminado']);
    }
    

}
