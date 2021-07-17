@extends('admin.layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.narrators.index') !!}"><i
                        class="fa fa-list mr-2"></i>{{trans('lang.narrators')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.narrators.create') !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.narrator')}} {{trans('lang.create')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-pencil mr-2"></i>{{trans('lang.narrator')}} {{trans('lang.update')}}</a>
            </li>
        </ul>
    </div>

    {!! Form::model($narrator, ['route' => ['admin.narrators.update', $narrator->id], 'method' => 'patch']) !!}

    <div class="card-body">
        <div class="row">
            @include('admin.narrators.fields')
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.save')}}
            {{trans('lang.narrators')}}</button>
        <a href="{!! url('admin/narrators/index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
            {{trans('lang.cancel')}}</a>
    </div>

    {!! Form::close() !!}

</div>
@endsection
