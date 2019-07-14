@extends('media-library::layouts.app')
@section('content')
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Media</h3>
                <div class="pull-right">
                    <a href="{{route('medias.list')}}">List Media</a>
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <form enctype="multipart/form-data" class="dropzone" id="custom-media-dropzone">
                    {{ csrf_field() }}
                    <div class="dz-message">
                        <div class="col-xs-8">
                            <div class="message">
                                <p>Drop files here or Click to Upload</p>
                            </div>
                        </div>
                    </div>
                    <div class="fallback">
                        <input name="file[]" type="file" multiple>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        Dropzone.autoDiscover = false;
        $("#custom-media-dropzone").dropzone({
            url: "{{route('media.create')}}",
            method: 'post',
            uploadMultiple: true,
            paramName: 'file',
            parallelUploads: 15,
            maxFilesize: 16,
            addRemoveLinks: true,
            // dictRemoveFile: '<i class="fa fa-2x fa-trash"></i>',
            dictRemoveFile: 'Remove File',
            dictFileTooBig: 'Image is larger than 2MB',
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    formData.append('uuid[]', file.upload.uuid);
                });
                this.on("removedfile", function (file) {
                    deleteImage(file.upload.uuid);
                });
            },
            success: function (data) {
                console.log('deleted');
            }
        });

    </script>
@endsection