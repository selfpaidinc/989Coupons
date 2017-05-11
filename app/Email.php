<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function coupons()
    {
        return $this->morphedByMany('App\Coupon', 'taggable');
    }

    public function ads()
    {
        return $this->morphedByMany('App\Ad', 'taggable');
    }
}
