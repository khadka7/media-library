<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('media-library::includes.header')


</head>
<body>
@include('media-library::includes.modal')
<div class="col-xs-12">
    <div class="box">
        <div class="box-body">
            <input type="text" placeholder="Upload Image" onclick="openMedia()" id="url">
        </div>
{{--        <a href="">Open Media</a>--}}
    </div>
</div>
</body>
@include('media-library::includes.footer')
</html>