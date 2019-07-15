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
        <div class="media">
            <div id="selected-image">
                <img src="" alt="" class="media-image1 img-thumbnail">
            </div>
            <input type="text" placeholder="Upload Image" onclick="openMedia()" id="url">
        </div>
    </div>
</div>
</body>
@include('media-library::includes.footer')
</html>
