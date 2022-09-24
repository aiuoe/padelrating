<div class="m-3">
    @can('score_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.scores.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.score.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.score.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-team1Player1Scores">
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
                                {{ trans('cruds.tournament.fields.mens') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.womens') }}
                            </th>
                            <th>
                                {{ trans('cruds.tournament.fields.mix') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.team_1_player_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.surname') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.team_1_player_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.surname') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.team_2_player_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.surname') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.team_2_player_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.surname') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_1_team_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_1_team_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_2_team_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_2_team_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_3_team_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.score.fields.set_3_team_2') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scores as $key => $score)
                            <tr data-entry-id="{{ $score->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $score->id ?? '' }}
                                </td>
                                <td>
                                    {{ $score->tournament->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $score->tournament->mens ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $score->tournament->mens ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $score->tournament->womens ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $score->tournament->womens ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $score->tournament->mix ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $score->tournament->mix ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $score->team_1_player_1->name ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_1_player_1->surname ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_1_player_2->name ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_1_player_2->surname ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_2_player_1->name ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_2_player_1->surname ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_2_player_2->name ?? '' }}
                                </td>
                                <td>
                                    {{ $score->team_2_player_2->surname ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_1_team_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_1_team_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_2_team_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_2_team_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_3_team_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $score->set_3_team_2 ?? '' }}
                                </td>
                                <td>
                                    @can('score_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.scores.show', $score->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('score_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.scores.edit', $score->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('score_delete')
                                        <form action="{{ route('admin.scores.destroy', $score->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('score_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.scores.massDestroy') }}",
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
  let table = $('.datatable-team1Player1Scores:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection