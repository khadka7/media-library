    <div class="panel-body">
        <div class="row">
            <div class="col-md-9">
                <div id="media">
                </div>
            </div>
            <div class="col-md-3">
                <h3>Image Information</h3>
                <div id="selected-image">
                    <img src="" alt="" class="image-status" >
                </div>
                <div class="input">
                    <div class="form-group">
                        <label for="url">Url:</label>
                        <input name="url" type="text" class="form-control" id="modal-url">
                    </div>
                    <div class="form-group">
                        <label for="filename">Filename</label>
                        <input name="filename" type="text" class="form-control" id="modal-filename">
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>

    $(function () {
        $('#media').slimScroll({
            height: '400px'
        });
    });
    $(document).ready(function () {
        var url = "{{route('ajax.medias.list')}}";
        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $("#media").html(data.data.template);
            }
        });
    });

</script>