<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function emails()
    {
        return $this->morphToMany('App\Email', 'taggable');
    }
}
