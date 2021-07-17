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
                <a class="nav-link active" href="{!! url()->current() !!}"><i
                        class="fa fa-plus mr-2"></i>{{trans('lang.create')}}</a>
            </li>
        </ul>
    </div>
    {!! Form::open(['route' => 'admin.audios.store', 'files' => true]) !!}
    <div class="card-body">
        <div class="row">
            @include('admin.audios.fields')
        </div>
    </div>

    <div class="card-footer">
        <!-- Submit Field -->
        <div class="form-group col-12 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.create')}}
                {{trans('lang.audio')}}</button>
            <a href="{!! url('admin/audios') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
                {{trans('lang.cancel')}}</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
