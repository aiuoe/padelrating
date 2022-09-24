<div class="m-3">
    @can('club_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.clubs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.club.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.club.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userClubs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.club.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.indoor_courts') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.outdor_courts') }}
                            </th>
                            <th>
                                {{ trans('cruds.club.fields.user') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clubs as $key => $club)
                            <tr data-entry-id="{{ $club->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $club->id ?? '' }}
                                </td>
                                <td>
                                    {{ $club->name ?? '' }}
                                </td>
                                <td>
                                    {{ $club->city ?? '' }}
                                </td>
                                <td>
                                    {{ $club->indoor_courts ?? '' }}
                                </td>
                                <td>
                                    {{ $club->outdor_courts ?? '' }}
                                </td>
                                <td>
                                    @foreach($club->users as $key => $item)
                                        <span class="badge badge-info">{{ $item->email }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('club_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.clubs.show', $club->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('club_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.clubs.edit', $club->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('club_delete')
                                        <form action="{{ route('admin.clubs.destroy', $club->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('club_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clubs.massDestroy') }}",
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
  let table = $('.datatable-userClubs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection