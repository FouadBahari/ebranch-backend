<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="partenersme">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('Frontend/ar/img/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('Frontend/ar/img/favicon.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/plugins/animate/animate.css')}}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/weather-icons/climacons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/fonts/meteocons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/charts/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/charts/chartist-plugin-tooltip.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/pages/chat-application.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/custom-rtl.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/core/menu/menu-types/vertical-content-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/pages/timeline.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/extensions/datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/vendors/css/extensions/timedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/pages/dashboard-ecommerce.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('Adminlook/css-rtl/style-rtl.css')}}">
    <!-- END Custom CSS-->
    @notify_css
    @yield('style')
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css">
</head>
<style>
    .btn-show-pass {
font-size: 20px;
color: #999999;
display: -webkit-box;
display: -webkit-flex;
display: -moz-box;
display: -ms-flexbox;
display: flex;
align-items: center;
position: absolute;
height: 100%;
top: 18px;
right: 30px;
padding: 0 5px;
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
}
.input-group .intl-tel-input .form-control {
  border-top-left-radius: 4px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 0;
}
</style>
<style>

.custom-switch {
    display: inline-block;
    position: relative;
    width: 60px;
    height: 30px;
}

.custom-switch input[type="checkbox"] {
    display: none;
}

.custom-switch label {
    cursor: pointer;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc; /* Default color for the switch track */
    border-radius: 30px;
    transition: background-color 0.2s;
}

.custom-switch .slider {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 26px;
    height: 26px;
    background-color: #fff; /* Default color for the switch button */
    border-radius: 50%;
    transition: transform 0.2s;
}

.custom-switch input:checked + label {
    background-color: #28a745; /* Color for the "on" state */
}

.custom-switch input:checked + label .slider {
    transform: translateX(30px);
}
</style>
<body class="vertical-layout vertical-menu 2-columns  menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->
@include('admin.includes.header')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.includes.sidebar')

@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.includes.footer')

@notify_js
@notify_render

<!-- BEGIN VENDOR JS-->
<script src="{{asset('Adminlook/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('Adminlook/vendors/js/ui/headroom.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/charts/chartist-plugin-tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"   type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/forms/switch.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('Adminlook/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>

<script src="{{asset('Adminlook/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/vendors/js/extensions/timedropper.min.js')}}" type="text/javascript"></script>

<script src="{{asset('Adminlook/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/pages/chat-application.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('Adminlook/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('Adminlook/js/scripts/pages/dashboard-crypto.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/tables/datatables/datatable-basic.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/extensions/date-time-dropper.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script src="{{asset('Adminlook/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('Adminlook/js/scripts/pages/dashboard-sales.js')}}" type="text/javascript"></script>

<script src="{{asset('Adminlook/js/scripts/pages/dashboard-ecommerce.js')}}" type="text/javascript"></script>

<script>
    $('body').click(function(){
        $('body').removeClass('menu-open').addClass('menu-hide');
        $('.nav-link.nav-menu-main.menu-toggle.hidden-xs').removeClass('is-active');
        $('#navbar-mobile22').removeClass('show');
    });
</script>
@yield('script')
<script>
    $(document).ready(function(){
        var showPass = 0;
        $('.btn-show-pass').on('click', function(){
            if(showPass == 0) {
                $(this).next('input').attr('type','text');
                $(this).find('i').removeClass('icon-eye');
                $(this).find('i').addClass('icon-eye-slash');
                showPass = 1;
            }else {
                $(this).next('input').attr('type','password');
                $(this).find('i').removeClass('icon-eye-slash');
                $(this).find('i').addClass('icon-eye');
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
</body>
</html>
