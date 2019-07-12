<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media Library</title>
    @include('media-library::includes.header')

</head>
<body>
<div class="container">
    @include('media-library::includes.modal')
    @yield('content')
</div>
@include('media-library::includes.footer')
</body>
</html>
