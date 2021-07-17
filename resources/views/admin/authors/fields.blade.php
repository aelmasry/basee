@push('css_lib')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush

<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name_en', __('lang.name_en'), ['class' => 'col-3 control-label text-center']) !!}
    <div class="col-9">
        {!! Form::text('name_en', null, ['class' => 'form-control'. ($errors->has('name_en') ? " is-invalid": ""),'maxlength'
        => 255,'maxlength' => 255, 'placeholder' => __('lang.author_name_placeholder'), 'required']) !!}
        @if ($errors->has('name_en'))
        <span class="error invalid-feedback">
            {{$errors->first('name_en')}}
        </span>
        @endif
    </div>
</div>

<!-- Brief Field -->
<div class="form-group row">
    {!! Form::label('brief_en', __('lang.brief_en'), ['class' => 'col-3 control-label text-center']) !!}
    <div class="col-9">
        {!! Form::textArea('brief_en', null, ['class' => 'form-control summernote'. ($errors->has('brief_en') ? " is-invalid":
        ""),'maxlength'
        => 255,'maxlength' => 255, 'placeholder' => __('lang.author_brief_placeholder'), 'required']) !!}
        @if ($errors->has('brief_en'))
        <span class="error invalid-feedback">
            {{$errors->first('brief_en')}}
        </span>
        @endif
    </div>
</div>

<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name_ar', __('lang.name_ar'), ['class' => 'col-3 control-label text-center']) !!}
    <div class="col-9">
        {!! Form::text('name_ar', null, ['class' => 'form-control'. ($errors->has('name_ar') ? " is-invalid":
        ""),'maxlength'
        => 255,'maxlength' => 255, 'placeholder' => __('lang.author_name_placeholder_ar'), 'required']) !!}
        @if ($errors->has('name_ar'))
        <span class="error invalid-feedback">
            {{$errors->first('name_ar')}}
        </span>
        @endif
    </div>
</div>

<!-- Brief Field -->
<div class="form-group row">
    {!! Form::label('brief_ar', __('lang.brief_ar'), ['class' => 'col-3 control-label text-center']) !!}
    <div class="col-9">
        {!! Form::textArea('brief_ar', null, ['class' => 'form-control summernote'. ($errors->has('brief_ar') ? "
        is-invalid":
        ""),'maxlength'
        => 255,'maxlength' => 255, 'placeholder' => __('lang.author_brief_placeholder_ar'), 'required']) !!}
        @if ($errors->has('brief_ar'))
        <span class="error invalid-feedback">
            {{$errors->first('brief_ar')}}
        </span>
        @endif
    </div>
</div>

<!-- Status Field -->
<div class="form-group row">
    {!! Form::label('status', __('lang.active'), ['class' => 'form-check-label col-3 control-label text-center']) !!}
    <label class="switch switch-icon switch-pill switch-primary switch-lg">
        {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('status', 1, null, ['class' => 'switch-input', 'checked' => ($author->status) ?? null]) !!}
        <span class="switch-label" data-on="" data-off=""></span>
        <span class="switch-handle"></span>
    </label>
</div>

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 55px;" class="column">
    <!-- Image Field -->
    <div class="form-group">
        {!! Form::label('image', trans("lang.author_image"), ['class' => 'col-6 control-label text-left']) !!}
        <div style="width: 100%; margin:0 0 10px;" class="dropzone image" id="image" data-field="image">
            <input type="hidden" name="image">
        </div>
        <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal"
            class="btn btn-outline-primary btn-sm float-left mt-1">{{ trans('lang.media_select')}}</a>
    </div>

    @prepend('scripts')
    <script type="text/javascript">
        var var1567114722110472716ble = '';
        @if(isset($author) && $author->hasMedia('image'))
        var1567114722110472716ble = {
            name: "{!! $author->getFirstMedia('image')->name !!}",
            size: "{!! $author->getFirstMedia('image')->size !!}",
            type: "{!! $author->getFirstMedia('image')->mime_type !!}",
            collection_name: "{!! $author->getFirstMedia('image')->collection_name !!}"};
        @endif
        var dz_var1567114722110472716ble = $(".dropzone.image").dropzone({
            url: "{!!url('uploads/store')!!}",
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function () {
            @if(isset($author) && $author->hasMedia('image'))
                dzInit(this,image,'{!! url($author->getFirstMediaUrl('image','thumb')) !!}')
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
                    file, image, '{!! url("admin/authors/remove-media") !!}',
                    'image', '{!! isset($author) ? $author->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    {{--dropzone--}}
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
            var dropzoneFields = [];
    </script>
    <script>
        $(function () {
            // summernote
            $('.summernote').summernote({
                tabsize: 2,
                height: 100
            });
        });

    </script>
@endpush
