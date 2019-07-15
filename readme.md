<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

 
## Basic Desciption
This simple media library. 


## Requirements
- [Image Intervention](http://image.intervention.io/).
- Be sure to add storage link ```php artisan storage:link```
- Need Dropzone js.

## Installation
- ```composer require khadka7/media-library```
- Add this to service provider
   ```  Khadka7\MediaLibrary\MediaServiceProvider::class, ``` 
- after this migrate your database
- Your routes will be auto added.
- Use vendor publish for dropzone js and css ```php artisan vendor:publish --tag=media-library-assets```
- Add these scripts to your master balde.
    ```
    <link rel="stylesheet" href="{{asset('vendor/media-library/css/dropzone.css')}}">
    <script src="{{asset('vendor/media-library/js/main.js')}}"></script>
    <script src="{{asset('vendor/media-library/js/dropzone.js')}}"></script>
    ```
- Add modal with modal Id - mediaModal in your blade file. 
  ```
  <div id="mediaModal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  ```              
## Usage
- Use this input to append your media url
```
<input type="text" onclick="openMedia()"">
```
- Go to /medias/list routes for media list
- You can add media from /media/add too.  
  
## Version

- version - 1.0 (beta)
  