<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }

    public function emails()
    {
        return $this->morphToMany('App\Email', 'taggable');
    }
}
