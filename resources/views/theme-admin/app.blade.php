<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/logo-k3.png') }}" type="image/x-icon">
    <title> {{$title}} | Lab. K3</title>
    @include('css.global')
    @stack('after-style')
</head>
<body>
<!-- Loader starts-->
{{ $loader }}
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <x-admin.header/>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <x-admin.sidebar/>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            {{ $slot }}
        </div>
        <!-- footer start-->
        <x-admin.footer/>
    </div>
</div>
@stack('after-script')
{{$script}}
</body>
</html>
