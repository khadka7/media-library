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
    </div>
</div>
</body>
@include('media-library::includes.footer')


<script>


    //opening modal form input
    function openMedia() {
        url = "{{ route('media.modal.open') }}";
        let modal = $('#myModal');
        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                modal.find('.modal-title').html('Insert Image');
                modal.find('.modal-body').html(data.template);
                modal.find('.modal-footer')
                    .html('<button class="btn btn-primary" onclick="insertUrl(event)" ">Insert Image</button>');
                modal.modal('toggle');
                modal.find(".modal-dialog").css('width', '1100px');
            },
            error: function (err) {
                console.log(err.responseText)
            }
        });
    }

    //on clicking image and adding value to input
    function insertUrl(e) {
        e.preventDefault();
        var modal = $('#myModal');
        var extractedUrl = $("#modal-url").val();
        $("#url").val(extractedUrl);
        modal.modal('toggle');
    }
</script>
</html>