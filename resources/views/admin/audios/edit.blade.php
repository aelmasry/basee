@extends('admin.layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.audios.index') !!}"><i
                        class="fa fa-list mr-2"></i>{{trans('lang.audios')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('admin.audios.create') !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.create')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-pencil mr-2"></i>{{trans('lang.update')}}</a>
            </li>
        </ul>
    </div>

    {!! Form::model($audio, ['route' => ['admin.audios.update', $audio->id], 'method' => 'patch', 'files' => true]) !!}

    <div class="card-body">
        <div class="row">
            @include('admin.audios.fields')
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.save')}}
            {{trans('lang.audio')}}</button>
        <a href="{!! url('admin/audios/index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
            {{trans('lang.cancel')}}</a>
    </div>

    {!! Form::close() !!}

</div>
@endsection
