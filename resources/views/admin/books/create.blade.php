@extends('admin.layouts.app')

@section('content')

@include('flash::message')
@include('common.errors')

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.books.index') !!}"><i
                        class="fa fa-list mr-2"></i>{{trans('lang.books')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.book')}} {{trans('lang.create')}}</a>
            </li>
        </ul>
    </div>
    {!! Form::open(['route' => 'admin.books.store']) !!}
    <div class="card-body">
        <div class="row">
            @include('admin.books.fields')
        </div>
    </div>

    <div class="card-footer">
        <!-- Submit Field -->
        <div class="form-group col-12 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.create')}}
                {{trans('lang.book')}}</button>
            <a href="{!! url('admin/books') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
                {{trans('lang.cancel')}}</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
