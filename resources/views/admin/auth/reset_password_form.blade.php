<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin Login</title>
    <!-- Toastr -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @include('admin.include.style')
</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>reset password  to continue .</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">

                        <div class="p-2" id="reset_form">
                            <form class="form-horizontal" action="{{route('admin.reset-password')}}" method="post" id="form_reset_submit">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter Your Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter username">
                                </div>
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
@include('admin.include.script')
@include('admin.auth.script')
</body>
</html>
