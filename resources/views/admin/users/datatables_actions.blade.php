{!! Form::open(['route' => ['admin.users.destroy', $id], 'method' => 'delete', 'id' => $id]) !!}
<div class='btn-group btn-group-sm'>
    {{--<a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}"
    href="{{ route('users.show', $id) }}" class='btn btn-link'>--}}
    {{--<i class="fa fa-eye"></i> </a>--}}
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}"
        href="{{ route('admin.users.edit', $id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i> </a>
            {!! Form::button('<i class="fa fa-trash"></i>', [
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => trans('lang.user_delete'),
                'class' => 'btn btn-link text-danger',
                'onclick' => "deleteConfirm($id)"
            ]) !!}

    <div class="dropdown">
        <a class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i> </a>
        <div class="dropdown-menu">
            <a class='dropdown-item' href="{{ route('admin.users.login-as-user', $id) }}"> <i
                    class="fa fa-sign-in mr-1"></i> {{trans('lang.user_login_as_user')}}
            </a>

            {{-- <a class='dropdown-item'
                href="{{ route('admin.users.profile') }}"><i class="fa fa-user mr-1"></i> {{trans('lang.user_profile')}}
            </a> --}}

        </div>
    </div>

</div>
{!! Form::close() !!}
