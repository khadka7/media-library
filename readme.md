<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

 
## Basic Desciption
This simple media library. 

## Installation
- ```composer require khadka7/media-library```
- Add this to service provider
   ```  Khadka7\MediaLibrary\MediaServiceProvider::class, ``` 
- after this migrate your database
- Your routes will be auto added.
- Use vendor publish for dropzone js and css ```php artisan vendor:publish --tag=media-library-assets```
    
## Requirements
- [Image Intervention](http://image.intervention.io/).
- Be sure to add storage link ```php artisan storage:link```
 
## Version

- version - 1.0 (beta)
  