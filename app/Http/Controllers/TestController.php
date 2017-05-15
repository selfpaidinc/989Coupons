<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Coupon;
use App\Email;

use Auth;

use Carbon\Carbon;

use App\Taggable;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function test() {
        return view('test');
    }
}
