<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Lab. K3</title>
    <!-- Google font-->
    @include('css.global')
    @stack('after-styles')
</head>
<body class="landing-wrraper">
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper landing-page">
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- header start-->
        <x-nav-bar/>
        <!-- header end-->
        <!--home section start-->
        {{ $slot }}

        <x-footer/>
        <!--footer end-->
    </div>
</div>
@stack('after-script')
{{$script}}
</body>
</html>
