<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Agency - Start Bootstrap Theme</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    @stack('after-styles')
</head>
<body id="page-top">
<!-- Navigation-->
<x-nav-bar></x-nav-bar>
<!-- Masthead-->
{{$slot}}

<!-- Footer-->
<x-footer></x-footer>
@stack('after-script')
{{$script}}
</body>
</html>
