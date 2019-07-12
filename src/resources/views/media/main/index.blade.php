@extends('media-library::layouts.app')

@section('content')

    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Media</h3>
                <div class="pull-right">
                    <a href="{{route('media.add')}}">Add Media</a>
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <a onclick="mode('list')" id="list" title="list view" style="cursor: pointer">
                    <i class="glyphicon glyphicon-th-list"></i>
                </a>
                <a onclick="mode('grid')"  id="grid" title="grid view" style="cursor: pointer">
                    <i class="glyphicon glyphicon-th-large"></i>
                </a>
                <div class="media-body">
                    <div class="view"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);

                }
            }
        });

        function mode(modename) {
            var url = '{{route('medias.list')}}';
            filterTemplate(url,modename);
        }

        function getData(page){
            var params = "?page="+page;
            url = '{{route('medias.list')}}';
            url = url+params;
            filterTemplate(url)

        }

        $(document).ready(function()
        {
            var url = '{{route('medias.list')}}';
            filterTemplate(url);
        });

        function filterTemplate(url,modeName='list') {
            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'mode': modeName},
                success: function (data) {
                    $(".view").html(data.data.template);
                }
            });
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var page=$(this).attr('href').split('page=')[1];
                getData(page)
            });
        }


        function detailImage(uuid) {
            var url="{{route('media.detail','UUID')}}";
            url = url.replace('UUID',uuid);
            let modal = $('#myModal');
            $.ajax({
                url:url,
                method:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (data) {
                    console.log(data);
                    modal.find('.modal-title').html('Image Detail');
                    modal.find('.modal-body').html(data.template);
                    modal.modal('toggle');
                    modal.find(".modal-dialog").css('width', '1100px');
                }
            });
        }

    </script>
@endsection