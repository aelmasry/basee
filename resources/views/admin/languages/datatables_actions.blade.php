<div class='btn-group btn-group-sm'>
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.translations')}}"
    href="{{ url('admin/languages/texts/'.$abbr) }}" class='btn btn-link'>
    <i class="fa fa-language"></i> {{trans('lang.translate')}} </a>

    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.edit')}}"
        href="{{ url('admin.languages.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"> {{trans('lang.edit')}} </i>
    </a>

    {!! Form::open(['route' => ['admin.languages.destroy', $id], 'method' => 'delete', 'id' => $id]) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'data-toggle' => 'tooltip',
    'data-placement' => 'bottom',
    'data-id' => $id,
    // 'type' => 'submit',
    'data-action' => route('admin.languages.destroy', $id),
    'title' => trans('lang.delete'),
    'class' => 'btn btn-link text-danger',
    'onclick' => "deleteConfirm($id)"
    ]) !!}
    {!! Form::close() !!}

</div>
