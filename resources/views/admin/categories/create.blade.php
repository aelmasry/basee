@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.categories.index') !!}"><i
                        class="fa fa-list mr-2"></i>{{trans('lang.category_table')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.category_create')}}</a>
            </li>
        </ul>
    </div>
    {!! Form::open(['route' => 'admin.categories.store']) !!}
    <div class="card-body">
        <div class="row">
            @include('admin.categories.fields')
        </div>
    </div>

    <div class="card-footer">
        <!-- Submit Field -->
        <div class="form-group col-12 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.create')}}
                {{trans('lang.category')}}</button>
            <a href="{!! url('admin/categories') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
                {{trans('lang.cancel')}}</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
