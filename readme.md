<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

 
## Basic Desciption
This simple media library. 

## Installation
- ```composer require khadka7/media-library```
- Add this to service provider
   ```  \Khadka7\MediaLibrary\MediaServiceProvider::class, ``` 
- after this migrate your database
- your routes will be auto added.
- use vendor publish for dropzone js and css ```php artisan vendor:publish --tag=media-library-assets```
    
## Requirements
- [Image Intervention](http://image.intervention.io/).
 
## Version

- version - 1.0
  