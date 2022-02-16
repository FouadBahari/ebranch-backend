<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PartenersMe">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('Frontend/ar/img/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('Frontend/ar/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/forms/icheck/custom.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/custom-rtl.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/pages/login-register.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/style-rtl.css')}}">
    <!-- END Custom CSS-->
    @notify_css
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
@yield('style')
<style>
.btn-show-pass {
    font-size: 20px;
    color: #999999;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: left;
    position: absolute;
    height: 100%;
    top: 12px;
    left: 30px;
    cursor: pointer;
    -webkit-transition: background 0.4s;
    -o-transition: background 0.4s;
    -moz-transition: background 0.4s;
    transition: background 0.4s;
}
</style>
<style>
.intl-tel-input {
    display: block;
    width:100%;
}
.intl-tel-input .selected-flag {
    z-index: 4;
}
.intl-tel-input .country-list {
    z-index: 5;
    text-align: right;
}
.input-group .intl-tel-input .form-control {
    border-top-left-radius: 4px;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 0;
}

.intl-tel-input.allow-dropdown .flag-container {
    right: 5px;
    left: 0;
}
</style>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- BEGIN VENDOR JS-->
<script src="{{asset('Adminlook/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('Adminlook/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
        type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('Adminlook/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/core/app.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('Adminlook/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script>

</script>
@notify_js
@notify_render
<script>
    $(document).ready(function(){
        var showPass = 0;
        $('.btn-show-pass').on('click', function(){
            if(showPass == 0) {
                $(this).next('input').attr('type','text');
                $(this).find('i').removeClass('la la-eye');
                $(this).find('i').addClass('la la-eye-slash');
                showPass = 1;
            }else {
                $(this).next('input').attr('type','password');
                $(this).find('i').removeClass('la la-eye-slash');
                $(this).find('i').addClass('la la-eye');
                showPass = 0;
            }

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.7/js/intlTelInput.js"></script>
<script>
$("input#phone").intlTelInput({
utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
});

$('.selected-flag').click(function(){
$('input#phone').val($('.country-list .country.active').find('.dial-code').html());
});
</script>
@yield('script')
</body>
</html>
