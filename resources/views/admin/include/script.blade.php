<!-- JAVASCRIPT -->
<script src="{{asset('public/admin/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('public/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('public/admin/assets/libs/node-waves/waves.min.js')}}"></script>

<script src="{{asset('public/admin/assets/js/toastr.js')}}"></script>
<!-- apexcharts -->
<script src="{{asset('public/admin/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<script src="{{asset('public/admin/assets/plugins/sweet_alert/sweetalert2.js')}}"></script>

<script src="{{asset('public/admin/assets/js/pages/dashboard.init.js')}}"></script>

@yield('js')
<!-- App js -->
<script src="{{asset('public/admin/assets/js/app.js')}}"></script>

<script>
    function route_alert(route, message) {
        Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c71d1d',
        cancelButtonColor: '#000',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                location.href = route;
            }
        })

    }
    @if(Session::has('message.success'))
    let success_message = "{{ Session::get('message.success') }}";
        Command: toastr["success"](success_message);
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    @endif
    @if(Session::has('message.info'))
    let success_message = "{{ Session::get('message.info') }}";
        Command: toastr["info"](success_message);
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    @endif
    @if(Session::has('message.wranning'))
    let success_message = "{{ Session::get('message.wranning') }}";
        Command: toastr["warning"](success_message);
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Command: toastr["error"]("Failed !!","{{$error}}")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        @endforeach
    @endif

</script>



