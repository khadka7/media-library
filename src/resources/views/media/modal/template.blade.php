<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li><a href="#upload-tab" data-toggle="tab">Upload</a></li>
        <li class="active"><a href="#gallery-tab" data-toggle="tab">Gallery</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane " id="upload-tab">
            <form enctype="multipart/form-data" class="dropzone" id="media-dropzone">
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
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="gallery-tab">
            <div class="row">
                <div class="col-md-12">
                    <form action="" id="mediaSearch">
                        <div class="col-md-3">
                            <input type="text" name="filename" placeholder="Search media...." class="form-control"
                                   id="searchFile" >
                        </div>

                    </form>
                </div>
            </div>
            <div id="gallery"></div>
        </div>

    </div>
    <!-- /.tab-content -->
</div>

<script>

$("#searchFile").on("keyup", function () {
    var a = $(this).val();
    var searchMediaUrl = "{{route('media.search')}}";
    $.ajax({
        url: searchMediaUrl, method: "GET", data: {filename: a}, dataType: "json", success: function (a) {
            $("#media").html(a.data.template)
        }
    })
});
    Dropzone.autoDiscover = false;
    $("#media-dropzone").dropzone({
        url: "{{route('media.create')}}",
        method: 'post',
        uploadMultiple: true,
        paramName: 'file',
        parallelUploads: 15,
        maxFilesize: 16,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove File',
        dictFileTooBig: 'Image is larger than 2MB',
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                formData.append('uuid[]', file.upload.uuid);
            });
            this.on("removedfile", function (file) {
                var delUrl = "{{route('media.delete','UUID')}}";
                delUrl = delUrl.replace('UUID', file.upload.uuid);
                $.ajax({
                    url: delUrl,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        modalGrid();
                        tabReload();
                    }
                });
            });
        },
        success: function () {
            modalGrid();
            tabReload();
        }
    });

    $(document).ready(function () {
        modalGrid();
    });

</script>
