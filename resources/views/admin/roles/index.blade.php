@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{!! url('admin/permissions') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.permission_table')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('admin/permissions/create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.permission_create')}}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link active" href="{!! url('admin/roles') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.role_table')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('admin/roles/create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.role_create')}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @include('admin.roles.table')
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

