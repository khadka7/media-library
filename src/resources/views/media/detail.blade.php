@extends('media-library::layouts.app')

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <img
                            src="{{asset($media->url)}}"
                            class="img-thumbnail" alt=""
                            width="auto"
                    >
                </div>
                <div class="col-md-5">
                    <form method="post" onsubmit="updateImage(this)">
                        @csrf
                        <div id="message">
                            <div id="message-content"></div>
                        </div>
                        <div class="input">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input name="title" type="text" class="form-control"
                                       value="{{$media ? $media->title : old('title')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="filename">Filename</label>
                                <input name="filename" type="text" class="form-control"
                                       value="{{$media ? $media->filename : old('filename')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="caption">Caption:</label>
                                <input name="caption" type="text" class="form-control"
                                       value="{{$media ? $media->caption : old('caption')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="url">Url:</label>
                                <input name="url" type="text" class="form-control" readonly
                                       value="{{$media ? $media->url : old('url')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="url">Descrption:</label>
                                <textarea name="" id="" cols="30" rows="10" class="form-control">
                                {{$media ? $media->description : old('description')}}
                            </textarea>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function updateImage(obj) {
        event.preventDefault();
        var uuid = "{{$media->uuid}}";
        var url = "{{route('media.update','UUID')}}";
        url = url.replace('UUID', uuid);
        var formData = new FormData(obj);
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#message-content').html(data.message).addClass('alert alert-success');
                $('#message-content').fadeOut(3000, function() {
                    $(this).remove();
                    $("#message").html('<div id="message-content"></div>');
                });
            },
            error: function (err) {
                console.log(err.responseText)
            }

        });
    }
</script>
