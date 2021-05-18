<div class="m-3">
    @can('tournament_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tournaments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tournament.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.tournament.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clubTournaments">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.startdate') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.enddate') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.mens') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.womens') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.mix') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.club') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.indoor_courts') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.outdor_courts') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tournaments as $key => $tournament)
                            <tr data-entry-id="{{ $tournament->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $tournament->id ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->name ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->startdate ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->enddate ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $tournament->mens ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $tournament->mens ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $tournament->womens ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $tournament->womens ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $tournament->mix ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $tournament->mix ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $tournament->city ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->club->name ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->club->indoor_courts ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->club->outdor_courts ?? '' }}
                                </td>
                                <td>
                                    @can('tournament_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.tournaments.show', $tournament->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('tournament_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.tournaments.edit', $tournament->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('tournament_delete')
                                        <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tournament_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tournaments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-clubTournaments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection