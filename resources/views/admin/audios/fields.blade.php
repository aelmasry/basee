<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Book Id Field -->
    <div class="form-group row">
        {!! Form::label('book_id', __('lang.books'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::select('book_id', $books, null, ['class' => 'form-control select2 text-left',
            'placeholder' => __('lang.select_please'), 'required']) !!}
        </div>
    </div>

    <!-- Name Field -->
    <div class="form-group row">
        {!! Form::label('name_en', __('lang.name_en'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('name_en', null, ['class' => 'form-control'. ($errors->has('name_en') ? " is-invalid":
            ""),'maxlength' => 255, 'placeholder' => __('lang.name_placeholder'), 'required']) !!}
            @if ($errors->has('name_en'))
            <span class="error invalid-feedback">
                {{$errors->first('name_en')}}
            </span>
            @endif
        </div>
    </div>

    <!-- type Id Field -->
    <div class="form-group row">
        {!! Form::label('type', __('lang.book_type_label'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::select('type', __('lang.audio_type_options'), null, ['class' => 'form-control select2 text-left',
            'placeholder' => __('lang.select_please'), 'required']) !!}
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
    <!-- Name Field -->
    <div class="form-group row">
        {!! Form::label('name_ar', __('lang.name_ar'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('name_ar', null, ['class' => 'form-control'. ($errors->has('name_ar') ? " is-invalid":
            ""),'maxlength'=> 255, 'placeholder' => __('lang.name_placeholder_ar'), 'required']) !!}
            @if ($errors->has('name_ar'))
            <span class="error invalid-feedback">
                {{$errors->first('name_ar')}}
            </span>
            @endif
        </div>
    </div>

    <!-- File Field -->
    <div class="form-group row">
        {!! Form::label('file', __('lang.audio_file'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::file('file', null, ['class' => 'form-file-input'. ($errors->has('file') ? " is-invalid":
            ""), 'required']) !!}
            @if ($errors->has('file'))
            <span class="error invalid-feedback">
                {{$errors->first('file')}}
            </span>
            @endif
        </div>
    </div>

</div>
