<div class='btn-group btn-group-sm'>
    {{--<a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}"
    href="{{ route('admin.categories.show', $id) }}" class='btn btn-link'>--}}
    {{--<i class="fa fa-eye"></i> </a>--}}
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.category_edit')}}"
        href="{{ route('admin.categories.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>

    {!! Form::open(['route' => ['admin.categories.destroy', $id], 'method' => 'delete', 'id' => $id]) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'data-toggle' => 'tooltip',
    'data-placement' => 'bottom',
    'data-id' => $id,
    // 'type' => 'submit',
    'data-action' => route('admin.categories.destroy', $id),
    'title' => trans('lang.category_delete'),
    'class' => 'btn btn-link text-danger',
    'onclick' => "deleteConfirm($id)"
    ]) !!}
    {!! Form::close() !!}

</div>
