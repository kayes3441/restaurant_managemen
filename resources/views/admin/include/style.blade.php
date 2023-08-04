<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('public/admin/assets/images/favicon.ico')}}">
<link href="{{asset('public/admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/sweet_alert/sweetalert2.css') }}">

@yield('add-css')

<!-- Icons Css -->
<link href="{{asset('public/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('public/admin/assets/css/toastr.css')}}">
<!-- App Css-->
<link href="{{asset('public/admin/assets/css/app.min.css')}}"  rel="stylesheet" type="text/css" />
