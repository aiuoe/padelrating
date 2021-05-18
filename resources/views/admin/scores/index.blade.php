@extends('layouts.admin')
@section('content')
@can('score_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.scores.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.score.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Score', 'route' => 'admin.scores.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.score.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Score">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.score.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.tournament') }}
                    </th>
                    <th>
                        {{ trans('cruds.tournament.fields.m') }}
                    </th>
                    <th>
                        {{ trans('cruds.tournament.fields.w') }}
                    </th>
                    <th>
                        {{ trans('cruds.tournament.fields.mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.team_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.team_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.set_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.set_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.score.fields.set_3') }}
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
@can('score_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.scores.massDestroy') }}",
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
    ajax: "{{ route('admin.scores.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'tournament_name', name: 'tournament.name' },
{ data: 'tournament.mens', name: 'tournament.mens' },
{ data: 'tournament.womens', name: 'tournament.womens' },
{ data: 'tournament.mix', name: 'tournament.mix' },
{ data: 'team_1', name: 'team_1' },
{ data: 'team_2', name: 'team_2' },/*
{ data: 'team_1_player_1_name', name: 'team_1_player_1.name' },
{ data: 'team_1_player_1.surname', name: 'team_1_player_1.surname' },
{ data: 'team_1_player_2_name', name: 'team_1_player_2.name' },
{ data: 'team_1_player_2.surname', name: 'team_1_player_2.surname' },
{ data: 'team_2_player_1_name', name: 'team_2_player_1.name' },
{ data: 'team_2_player_1.surname', name: 'team_2_player_1.surname' },
{ data: 'team_2_player_2_name', name: 'team_2_player_2.name' },
{ data: 'team_2_player_2.surname', name: 'team_2_player_2.surname' },*/
{ data: 'set_1', name: 'set_1' },
{ data: 'set_2', name: 'set_2' },
{ data: 'set_3', name: 'set_3' },/*
{ data: 'set_1_team_1', name: 'set_1_team_1' },
{ data: 'set_1_team_2', name: 'set_1_team_2' },
{ data: 'set_2_team_1', name: 'set_2_team_1' },
{ data: 'set_2_team_2', name: 'set_2_team_2' },
{ data: 'set_3_team_1', name: 'set_3_team_1' },
{ data: 'set_3_team_2', name: 'set_3_team_2' },*/
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Score').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection