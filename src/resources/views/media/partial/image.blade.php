@foreach ($medias as $media)
    <img
            src="{{asset($media->thumbnail_url)}}"
            class="img-thumbnail" alt=""
            onclick="imageInfo('{{$media->uuid}}')"
            style="cursor: pointer"
    >
@endforeach
