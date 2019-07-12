<?php

namespace Khadka7\MediaLibrary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'media';

    protected $fillable = [
        'filename','uuid','original_name','filetype','filesize','dimension','url','thumbnail_url','title','caption','description',
    ];


}
