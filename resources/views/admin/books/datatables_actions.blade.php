<div class='btn-group btn-group-sm'>
    {{--<a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}"
    href="{{ route('admin.books.show', $id) }}" class='btn btn-link'>--}}
    {{--<i class="fa fa-eye"></i> </a>--}}
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.audios')}}"
       href="{{ route('admin.audios.index', ['bookId' => $id]) }}" class='btn btn-link'>
        <i class="fa fa-file-audio-o" aria-hidden="true"></i>
    </a>
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.edit')}}"
        href="{{ route('admin.books.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>

    {!! Form::open(['route' => ['admin.books.destroy', $id], 'method' => 'delete', 'id' => $id]) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'data-toggle' => 'tooltip',
    'data-placement' => 'bottom',
    'data-id' => $id,
    // 'type' => 'submit',
    'data-action' => route('admin.books.destroy', $id),
    'title' => trans('lang.author_delete'),
    'class' => 'btn btn-link text-danger',
    'onclick' => "deleteConfirm($id)"
    ]) !!}
    {!! Form::close() !!}

</div>
