<div class="m-3">
    @can('player_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.players.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.player.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.player.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userPlayers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.player.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.surname') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.genre') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.birthdate') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.license_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.player.fields.user') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $key => $player)
                            <tr data-entry-id="{{ $player->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $player->id ?? '' }}
                                </td>
                                <td>
                                    {{ $player->name ?? '' }}
                                </td>
                                <td>
                                    {{ $player->surname ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Player::GENRE_SELECT[$player->genre] ?? '' }}
                                </td>
                                <td>
                                    {{ $player->birthdate ?? '' }}
                                </td>
                                <td>
                                    {{ $player->license_number ?? '' }}
                                </td>
                                <td>
                                    {{ $player->user->email ?? '' }}
                                </td>
                                <td>
                                    @can('player_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.players.show', $player->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('player_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.players.edit', $player->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('player_delete')
                                        <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('player_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.players.massDestroy') }}",
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
  let table = $('.datatable-userPlayers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection