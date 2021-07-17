@extends('admin.layouts.app')
@push('css_lib')
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-user mr-2"></i> {{trans('lang.user_about_me')}}</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img src="{{$user->getFirstMediaUrl('media','thumb')}}" class="profile-user-img img-fluid img-circle" alt="{{$user->name}}">
                            </div>
                            <h3 class="profile-username text-center">{{$user->name}}</h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    @include('flash::message')
                    @include('common.errors')
                    <div class="clearfix"></div>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-cog mr-2"></i>{{trans('lang.user_profile')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH', 'files' =>true]) !!}
                            <div class="row">
                                @include('admin.users.fields')
                            </div>
                            {!! Form::close() !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.layouts.media_modal',['collection'=>null])
@endsection
@push('scripts_lib')
    {{--dropzone--}}
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
    <script type="text/javascript">
        var avatar = '';
        @if(isset($user) && $user->hasMedia('media'))
            avatar = {
                name: "{!! $user->getFirstMedia('media')->name !!}",
                size: "{!! $user->getFirstMedia('media')->size !!}",
                type: "{!! $user->getFirstMedia('media')->mime_type !!}",
                collection_name: "{!! $user->getFirstMedia('media')->collection_name !!}"
            };
        @endif
        var dz_avatar = $(".dropzone.logo").dropzone({
                url: "{!!url('uploads/store')!!}",
                addRemoveLinks: true,
                maxFiles: 1,
                init: function () {
                    @if(isset($user) && $user->hasMedia('media'))
                    dzInit(this, avatar, '{!! url($user->getFirstMediaUrl('media')) !!}')
                    @endif
                },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "{!!config('media-library.icons_folder')!!}");
                },
                sending: function (file, xhr, formData) {
                    dzSending(this, file, formData, '{!! csrf_token() !!}');
                },
                maxfilesexceeded: function (file) {
                    dz_avatar[0].mockFile = '';
                    dzMaxfile(this, file);
                },
                complete: function (file) {
                    dzComplete(this, file, avatar, dz_avatar[0].mockFile);
                    dz_avatar[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFile(
                        file, avatar, '{!! url("dashboard/users/remove-media") !!}',
                        'media', '{!! isset($user) ? $user->id : 0 !!}', '{!! url("uploads/clear") !!}', '{!! csrf_token() !!}'
                    );
                }
            });
        dz_avatar[0].mockFile = avatar;
        dropzoneFields['logo'] = dz_avatar;
    </script>
@endpush
