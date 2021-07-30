@push('css_lib')
{{--dropzone--}}
<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Name Field -->
    <div class="form-group row">
        {!! Form::label('name', __('lang.name'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('name', null, ['class' => 'form-control'. ($errors->has('name') ? " is-invalid":
            ""),'maxlength' => 100, 'placeholder' => __('lang.name_placeholder'), 'required']) !!}
            @if ($errors->has('name'))
            <span class="error invalid-feedback">
                {{$errors->first('name')}}
            </span>
            @endif
        </div>
    </div>


    <!-- Abbr Field -->
    <div class="form-group row">
        {!! Form::label('abbr', __('lang.abbr'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('abbr', null, ['class' => 'form-control'. ($errors->has('abbr') ? " is-invalid":
            ""),'maxlength'=> 3, 'placeholder' => __('lang.abbr_placeholder'), 'required']) !!}
            @if ($errors->has('abbr'))
            <span class="error invalid-feedback">
                {{$errors->first('abbr')}}
            </span>
            @endif
        </div>
    </div>

    <!-- Status Field -->
    <div class="form-group row">
        {!! Form::label('status', __('lang.active'), ['class' => 'form-check-label col-3 control-label text-center'])
        !!}
        <div class="col-9">
            <label class="switch switch-icon switch-pill switch-primary switch-lg">
                {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
                {!! Form::checkbox('status', 1, null, ['class' => 'switch-input', 'checked' => ($author->status) ??
                null]) !!}
                <span class="switch-label" data-on="" data-off=""></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 55px;" class="column">
    <!-- Native Field -->
    <div class="form-group row">
        {!! Form::label('native', __('lang.native'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('native', null, ['class' => 'form-control'. ($errors->has('native') ? " is-invalid":
            ""),'maxlength'=> 20, 'placeholder' => __('lang.native_placeholder'), 'required']) !!}
            @if ($errors->has('native'))
            <span class="error invalid-feedback">
                {{$errors->first('native')}}
            </span>
            @endif
        </div>
    </div>

    <!-- default Field -->
    <div class="form-group row">
        {!! Form::label('default', __('lang.default'), ['class' => 'form-check-label col-3 control-label text-center'])
        !!}
        <div class="col-9">
            <label class="switch switch-icon switch-pill switch-primary switch-lg">
                {!! Form::hidden('default', 0, ['class' => 'form-check-input']) !!}
                {!! Form::checkbox('default', 1, null, ['class' => 'switch-input', 'checked' => ($author->status) ??
                null]) !!}
                <span class="switch-label" data-on="" data-off=""></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>

</div>

@include('admin.layouts.media_modal')
@push('scripts_lib')
{{--dropzone--}}
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
            var dropzoneFields = [];
</script>
@endpush
