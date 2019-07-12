@if($medias->isNotEmpty())
    @if($mode == 'grid')
        <h2>Images Thumbnail</h2>
        <div id="grid-mode">
            @foreach ($medias as $media)
                <img class="img-thumbnail" src="{{asset($media->thumbnail_url)}}" alt="" \
                     onclick="detailImage('{{$media->uuid}}')">
            @endforeach

        </div>

    @else
        <div id="list-mode">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Thumbnail</th>
                    <th>Filename</th>
                    <th>Filesize</th>
                    <th>ACtion</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($medias as $media)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <img src="{{asset($media->thumbnail_url)}}" alt="">
                        </td>
                        <td>{{$media->filename}}</td>
                        <td>{{$media->filesize}}</td>
                        <td>
                            <a href="#" onclick="detailImage('{{$media->uuid}}')">View</a>
                            <a href="#" onclick="removeImage('{{$media->uuid}}')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-sm-12">
                <div class="pagination pull-right">
                    {{$medias->links()}}
                </div>
            </div>
        </div>
    @endif

@else
    No Content
@endif

<script>
    $(function () {
        $('#grid-mode').slimScroll({
            height: '600px'
        });
    });

    function removeImage(uuid){
        deleteImage(uuid);
        location.reload();
    }

</script>