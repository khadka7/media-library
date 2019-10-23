
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    let mediaCreateUrl = "{{route('media.create')}}";
    let mediaListUrl = "{{route('medias.list')}}";
    let ajaxMediaListUrl = "{{route('ajax.medias.list')}}";
    let modalGridViewUrl = "{{route('media.modal.grid')}}";
    let openModalUrl = "{{route('media.modal.open')}}";
    let searchMediaUrl = "{{route('media.search')}}";
    let detailImageUrl = "{{route('media.detail','ID')}}";
    let deleteImageUrl = "{{route('media.delete','ID')}}";
    let imageInfoUrl = "{{route('media.info','ID')}}"
    let updateUrl = "{{route('media.update','ID')}}";
</script>
<script src="{{asset('vendor/media-library/js/dropzone.js')}}"></script>
<script src="{{asset('vendor/media-library/js/main.js')}}"></script>
@yield("script")
