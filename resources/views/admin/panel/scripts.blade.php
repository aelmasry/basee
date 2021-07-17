<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
{{-- sweetalert --}}
<script src="{{asset('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
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
<script>
    window.deleteConfirm = function(formId) {
        Swal.fire({
            title: "<strong> {{trans('lang.error')}} </strong>",
            icon: "warning",
            html: "<strong> {{trans('lang.do_you_want_to_delete_this')}} </strong>",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-trash fa-3'></i> {{trans('lang.yes_do_it')}}",
            confirmButtonColor: "#e3342f",
            focusConfirm: false,
            showCloseButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

