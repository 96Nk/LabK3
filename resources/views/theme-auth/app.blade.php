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
    <style>
        body{
            background-color: #b9b8bb;
        }
    </style>
</head>
<body>
<x-loader-theme/>
<section>
    {{ $slot }}
</section>
@stack('after-script')
{{$script}}
</body>
</html>
