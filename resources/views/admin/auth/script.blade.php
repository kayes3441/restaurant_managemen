<script src="{{asset('/')}}admin/assets/js/toastr.js"></script>

<script>
    $('#submit_form form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method  : $(this).attr('method'),
            url     : $(this).attr('action'),
            data    : $('#form').serialize(),
            success:function (response) {
                console.log(response)
                if (response.success == true) {
                    $('#submit_form form')[0].reset()
                    Command: toastr["success"]("Ok", "Successfully Login")
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
                    setTimeout(function() {
                        window.location.href = "{{url('/admin/dashboard')}}";
                    }, 1000);
                }
                else {
                    Command: toastr["error"]("Fail",'Please Enter Email And Password')
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
                }
            }
        })
    })



    $('#reset_form form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method  : $(this).attr('method'),
            url     : $(this).attr('action'),
            data    : $('#form_reset_submit').serialize(),
            success:function (response) {
                console.log(response)
                if (response.success == false) {
                    $('#reset_form form')[0].reset()
                    // for(let value in response.message) {
                        Command: toastr["error"]("Fail",response.message.email)
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
                    //}
                }
                if (response.success == true) {
                    $('#reset_form form')[0].reset()
                    // for(let value in response.message) {
                    Command: toastr["success"]("OK","Check Your Spam  Folder")
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
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    setTimeout(function() {
                        window.location.href = "{{url('/admin/login-form')}}";
                    },1000);
                    //}
                }
            }
        })
    })

    //update password form
    $('#update_password_form form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method  : $(this).attr('method'),
            url     : $(this).attr('action'),
            data    : $('#updateForm').serialize(),
            success:function (response) {
                console.log(response)
                if (response.success == true) {
                    $('#update_password_form form')[0].reset()
                    Command: toastr["success"]("Ok", response.message)
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
                    setTimeout(function() {
                        window.location.href = "{{url('/admin/dashboard')}}";
                    }, 1000);
                }
                else {
                    Command: toastr["error"]("Fail",response.message.password)
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
                }
            }
        })
    })





</script>
