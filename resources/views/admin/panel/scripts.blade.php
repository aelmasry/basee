<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
{{-- sweetalert --}}
<script src="{{asset('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- Noty 3.1.4 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- select2 -->
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor/pace.min.js') }}"></script>
<!-- Plugins and scripts required by all views -->
<script src="{{ asset('js/vendor/Chart.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

<!-- CoreUI main scripts -->
@stack('media_scripts')
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>
@stack('scripts_lib')
@stack('scripts')

