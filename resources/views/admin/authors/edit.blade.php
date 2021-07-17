@extends('admin.layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.authors.index') !!}"><i
                        class="fa fa-list mr-2"></i>{{trans('lang.authors_table')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.authors.create') !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.author_create')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-pencil mr-2"></i>{{trans('lang.author_update')}}</a>
            </li>
        </ul>
    </div>

    {!! Form::model($author, ['route' => ['admin.authors.update', $author->id], 'method' => 'patch']) !!}

    <div class="card-body">
        <div class="row">
            @include('admin.authors.fields')
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.save')}}
            {{trans('lang.author')}}</button>
        <a href="{!! url('admin/authors/index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
            {{trans('lang.cancel')}}</a>
    </div>

    {!! Form::close() !!}

</div>
@endsection
