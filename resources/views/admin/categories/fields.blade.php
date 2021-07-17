@push('css_lib')
{{--dropzone--}}
<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush

<div style="flex: 50%;max-width: 50%;padding: 0 55px;" class="column">
    <!-- Name Field -->
    <div class="form-group row">
        {!! Form::label('name_en', __('lang.name_en'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
        {!! Form::text('name_en', null, ['class' => 'form-control'. ($errors->has('name_en') ? " is-invalid": ""),'maxlength' => 255,'maxlength' => 255, 'placeholder' => __('lang.name_placeholder'), 'required']) !!}
        @if ($errors->has('name_en'))
        <span class="error invalid-feedback">
            {{$errors->first('name_en')}}
        </span>
        @endif
        </div>
    </div>

<!-- Name Field -->
    <div class="form-group row">
        {!! Form::label('name_ar', __('lang.name_ar'), ['class' => 'col-3 control-label text-center']) !!}
        <div class="col-9">
            {!! Form::text('name_ar', null, ['class' => 'form-control'. ($errors->has('name_ar') ? " is-invalid":
            ""),'maxlength'  => 255,'maxlength' => 255, 'placeholder' => __('lang.name_placeholder_ar'), 'required']) !!}
            @if ($errors->has('name_ar'))
            <span class="error invalid-feedback">
                {{$errors->first('name_ar')}}
            </span>
            @endif
        </div>
    </div>

    <!-- Parent Id Field -->
    <div class="form-group row">
        {!! Form::label('parent_id', __('lang.parent'), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('parent_id', $categories, 0, ['class' => 'form-control select2 text-left', 'placeholder' =>
            __('lang.select_please')]) !!}
        </div>
    </div>


<!-- Status Field -->
<div class="form-group row">
    {!! Form::label('status', __('lang.active'), ['class' => 'form-check-label col-3 control-label text-right']) !!}
    <label class="switch switch-icon switch-pill switch-primary switch-lg">
        {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('status', 1, null, ['class' => 'switch-input', 'checked' => ($category->status) ?? null]) !!}
        <span class="switch-label" data-on="" data-off=""></span>
        <span class="switch-handle"></span>
    </label>
</div>
</div>

<div style="flex: 50%;max-width: 50%;padding: 0 55px;" class="column">
    <!-- Image Field -->
    <div class="form-group">
        <div style="width: 100%; margin:0 0 10px;" class="dropzone image" id="image" data-field="image">
            <input type="hidden" name="image">
        </div>
        <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal"
            class="btn btn-outline-primary btn-sm float-left mt-1">{{ trans('lang.media_select')}}</a>
    </div>

    @prepend('scripts')
    <script type="text/javascript">
        var var1567114722110472716ble = '';
        @if(isset($category) && $category->hasMedia('category'))
        var1567114722110472716ble = {
            name: "{!! $category->getFirstMedia('category')->name !!}",
            size: "{!! $category->getFirstMedia('category')->size !!}",
            type: "{!! $category->getFirstMedia('category')->mime_type !!}",
            collection_name: "{!! $category->getFirstMedia('category')->collection_name !!}"};
        @endif
        var dz_var1567114722110472716ble = $(".dropzone.image").dropzone({
            url: "{!!url('uploads/store')!!}",
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function () {
            @if(isset($category) && $category->hasMedia('category'))
                dzInit(this,image,'{!! url($category->getFirstMediaUrl('category','thumb')) !!}')
            @endif
            },
            accept: function(file, done) {
                dzAccept(file,done,this.element,"{!!config('medialibrary.icons_folder')!!}");
            },
            sending: function (file, xhr, formData) {
                dzSending(this,file,formData,'{!! csrf_token() !!}');
            },
            maxfilesexceeded: function (file) {
                dz_var1567114722110472716ble[0].mockFile = '';
                dzMaxfile(this,file);
            },
            complete: function (file) {
                dzComplete(this, file, image, dz_var1567114722110472716ble[0].mockFile);
                dz_var1567114722110472716ble[0].mockFile = file;
            },
            removedfile: function (file) {
                dzRemoveFile(
                    file, image, '{!! url("admin/categorys/remove-media") !!}',
                    'image', '{!! isset($category) ? $category->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                );
            }
        });
        dz_var1567114722110472716ble[0].mockFile = var1567114722110472716ble;
        dropzoneFields['image'] = dz_var1567114722110472716ble;
    </script>
    @endprepend
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
