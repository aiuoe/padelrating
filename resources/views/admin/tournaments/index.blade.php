@extends('layouts.admin')
@section('content')
@can('tournament_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tournaments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tournament.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Tournament', 'route' => 'admin.tournaments.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.tournament.title') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Tournament">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tournament_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tournaments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.tournaments.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'startdate', name: 'startdate' },
{ data: 'enddate', name: 'enddate' },
{ data: 'mens', name: 'mens' },
{ data: 'womens', name: 'womens' },
{ data: 'mix', name: 'mix' },
{ data: 'city', name: 'city' },
{ data: 'club_name', name: 'club.name' },
{ data: 'club.indoor_courts', name: 'club.indoor_courts' },
{ data: 'club.outdor_courts', name: 'club.outdor_courts' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Tournament').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection