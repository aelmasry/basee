<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ali Salem">
    <link rel="shortcut icon" href="{{ asset('ico/favicon.png')}}">

    <title>{{trans('lang.app_name')}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Styles required by this views -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">

    <!-- Scripts -->
    @stack('css_lib')

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    @include('admin.panel.navbar')
    <div class="app-body">
        @include('admin.panel.sidebar')
        <div class="main">
            <!-- Breadcrumb -->
            @include('admin.panel.breadcrumb')
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('flash::message')
                            @include('common.errors')
                            @yield('content')
                         </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('admin.panel.asidemenu') --}}
    </div>


    @include('admin.panel.footer')

    @include('admin.panel.scripts')
</body>

</html>
