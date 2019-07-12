<script src="{{asset('vendor/media-library/js/dropzone.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>

<script>
    Dropzone.options.mediaDropzone = {
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
                console.log(file.upload.uuid);
                formData.append('uuid[]', file.upload.uuid);
            });
            this.on("removedfile", function (file) {
                deleteImage(file.upload.uuid);
            });
        },
        success: function (data) {
            console.log('deleted');
        }
    };

    function deleteImage(uuid) {
        var confirmMessage = confirm('Do you want to delete this image');
        if (confirmMessage === true){
            var delUrl = "{{route('media.delete','UUID')}}";
            delUrl = delUrl.replace('UUID',uuid);
            $.ajax({
                url: delUrl,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log('deleted');
                }
            });
        }

    }
</script>
@yield("script")
