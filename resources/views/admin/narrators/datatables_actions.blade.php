<div class='btn-group btn-group-sm'>
    {{--<a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}"
    href="{{ route('admin.narrators.show', $id) }}" class='btn btn-link'>--}}
    {{--<i class="fa fa-eye"></i> </a>--}}
    <a data-toggle="tooltip" data-placement="bottom" title="{{__('lang.edit', ['operator' => __('lang.narrator')])}}"
        href="{{ route('admin.narrators.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>

    {!! Form::open(['route' => ['admin.narrators.destroy', $id], 'method' => 'delete', 'id' => $id]) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'data-toggle' => 'tooltip',
    'data-placement' => 'bottom',
    'data-id' => $id,
    // 'type' => 'submit',
    'data-action' => route('admin.narrators.destroy', $id),
    'title' => __('lang.delete', ['operator' => __('lang.narrator')]),
    'class' => 'btn btn-link text-danger',
    'onclick' => "deleteConfirm($id)"
    ]) !!}
    {!! Form::close() !!}

</div>
