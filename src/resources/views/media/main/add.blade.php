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
        </div>
    </div>

@endsection
