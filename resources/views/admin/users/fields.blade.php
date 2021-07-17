<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.user_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_name_placeholder")]) !!}

        </div>
    </div>

    <!-- Email Field -->
    <div class="form-group row ">
        {!! Form::label('email', trans("lang.user_email"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('email', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_email_placeholder")]) !!}

        </div>
    </div>

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Password Field -->
    <div class="form-group row ">
        {!! Form::label('password', trans("lang.user_password"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::password('password', ['class' => 'form-control','placeholder'=>  trans("lang.user_password_placeholder")]) !!}
        </div>
    </div>

    @role('admin')
    <!-- Roles Field -->
    <div class="form-group row ">
        {!! Form::label('roles[]', trans("lang.user_role_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('roles[]', $role, $rolesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
        </div>
    </div>
    @endrole

</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.user')}}</button>
    <a href="{!! url('admin/users/index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
