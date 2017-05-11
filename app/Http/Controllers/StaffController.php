<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Email;
use App\Ad;
use App\Image;

use Auth;

use Carbon\Carbon;

use App\Taggable;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ads()
    {
        $ads = Ad::orderBy('id','desc')->paginate(20);
        return view('staff.ads', ['ads'=>$ads]);
    }

    public function adsDelete($id)
    {
        if( Auth::user()->role == 'admin' )
        {
            $ad = Ad::findOrFail($id);
            $ad->delete();
        }
        return redirect('/staff/ads');
    }

    public function emailsPreview($id)
    {
        $email = Email::findOrFail($id);

        $ads = [];
        $ads['b'] = [];

        //$coupons = [];

        foreach( $email->ads AS $ad )
        {
           if( $ad->class == 'a' )
           {
               $ads['a'] = $ad;
           }
           else
           {
               $ads['b'][] = $ad;
           }
        }

        return view('emails.newsletter',['email'=>$email,'ads'=>$ads]);
    }

    public function adsCreate(Request $request)
    {

        if( $request->isMethod('post') )
        {
            $ad = new Ad;
            if( Auth::user()->role == 'admin' )
            {
                $ad->status = $request->status;
            }
            elseif ( env('APP_STAFF_AD_STATUS') == 'disabled' )
            {
                $ad->status = env('APP_STAFF_AD_STATUS');
            }
            else
            {
                $ad->status = $request->status;
            }
            $ad->class = $request->class;

            $img_id = explode('cropped-', $request->image);
            $img_id = explode('.', $img_id[1]);

            $img = Image::where('filename',$img_id[0])->first();

            $ad->image_id = $img->id;
            $ad->title = $request->title;
            $ad->url = $request->url;
            $ad->save();

            if( $request->has('emails') )
            {
                foreach( $request->emails AS $link_email )
                {
                    $insert = new Taggable;
                    $insert->email_id = $link_email;
                    $insert->taggable_id = $ad->id;
                    $insert->taggable_type = 'App\Ad';
                    $insert->save();
                }
            }

            $request->session()->flash('alert-success', __('app.msg_ad_created'));
            return redirect('/staff/ads/edit/'.$ad->id);
        }

        $choices = [];
        $choices['available'] = [];

        foreach( Email::where('send_date','>=',Carbon::now()->toDateString())->orWhere([['send_date','<',Carbon::now()->toDateString()],['sent','=',0]])->get() AS $email )
        {
            if( $email->sent == 1 ) continue;
            $choices['available'][] = $email;
        }

        return view('staff.ads_create', ['choices'=>$choices]);
    }

    public function adsEdit($id, Request $request)
    {
        $ad = Ad::findOrFail($id);
        if( $request->isMethod('post') )
        {
            foreach( $ad->emails AS $email )
            {
                if( $email->sent != 1 )
                {
                    Taggable::where([['email_id','=',$email->id],['taggable_id','=',$ad->id],['taggable_type','=','App\Ad']])->delete();
                }
            }

            if( $request->has('emails') )
            {
                foreach( $request->emails AS $link_email )
                {
                    $insert = new Taggable;
                    $insert->email_id = $link_email;
                    $insert->taggable_id = $ad->id;
                    $insert->taggable_type = 'App\Ad';
                    $insert->save();
                }
            }

            if( Auth::user()->role == 'admin' )
            {
                $ad->status = $request->status;
            }
            elseif ( env('APP_STAFF_AD_STATUS') == 'disabled' )
            {
                $ad->status = env('APP_STAFF_AD_STATUS');
            }
            else
            {
                $ad->status = $request->status;
            }

            $ad->class = $request->class;
            if( !is_null($request->image) )
            {
                $img_id = explode('cropped-', $request->image);
                $img_id = explode('.', $img_id[1]);
                $img = Image::where('filename',$img_id[0])->first();
                $ad->image_id = $img->id;
            }
            $ad->title = $request->title;
            $ad->url = $request->url;
            $ad->save();

            $request->session()->flash('alert-success', __env('app.msg_ad_updated'));
        }
        $choices = [];
        $choices['available'] = [];
        $choices['sent'] = [];
        $choices['ids'] = [];

        foreach( $ad->emails AS $email )
        {
            if( $email->sent == 1 )
            {
                $choices['sent'][] = $email;
            }
            else
            {
                $choices['ids'][] = $email->id;
            }
        }

        foreach( Email::where('send_date','>=',Carbon::now()->toDateString())->get() AS $email2 )
        {
            if( $email2->sent == 1 ) continue;
            $choices['available'][] = array('data'=>$email2,'selected'=>(!in_array( $email2->id, $choices['ids'] )?false:true));
        }
        return view('staff.ads_edit', ['ad'=>$ad,'choices'=>$choices]);
    }

    public function emails()
	{
		$emails = Email::orderBy('id','desc')->paginate(15);
		
		return view('staff.emails', ['emails'=>$emails]);
	}
	
	public function emailsEdit($id, Request $request)
	{
		$email = Email::findOrFail($id);
		
		if( $request->isMethod('post') )
		{
			
			foreach( $email->coupons AS $coupon )
			{
				Taggable::where([['email_id','=',$email->id],['taggable_id','=',$coupon->id],['taggable_type','=','App\Coupon']])->delete();
			}

            foreach( $email->ads AS $ad )
            {
                Taggable::where([['email_id','=',$email->id],['taggable_id','=',$ad->id],['taggable_type','=','App\Ad']])->delete();
            }
			
			if( $request->has('coupons') )
			{
				foreach( $request->coupons AS $link_coupon )
				{
					$insert = new Taggable;
					$insert->email_id = $email->id;
					$insert->taggable_id = $link_coupon;
					$insert->taggable_type = 'App\Coupon';
					$insert->save();
				}
			}

            if( $request->has('ads') )
            {
                foreach( $request->ads AS $link_ad )
                {
                    $insert = new Taggable;
                    $insert->email_id = $email->id;
                    $insert->taggable_id = $link_ad;
                    $insert->taggable_type = 'App\Ad';
                    $insert->save();
                }
            }
            if( Auth::user()->role == 'admin' )
            {
                $email->status = $request->status;
            }
            elseif ( env('APP_STAFF_EMAIL_STATUS') == 'disabled' )
            {
                $email->status = env('APP_STAFF_EMAIL_STATUS');
            }
            else
            {
                $email->status = $request->status;
            }
			$email->subject_line = $request->subject_line;
			$email->save();
			
			$email = Email::findOrFail($id);
			
			$request->session()->flash('alert-success', __('app.msg_email_updated'));
		}
		
		$ids = [];
		$coupons = [];

		$ad_ids = [];
		$ads = [];
		
		foreach( $email->coupons AS $coupon )
		{
			$ids[] = $coupon->id;
		}
        foreach( $email->ads AS $ad )
        {
            $ad_ids[] = $ad->id;
        }
		
		foreach( Coupon::where('barcode_ends','>=',Carbon::now()->toDateString())->get() AS $coupon )
		{
			$coupons[] = array('data'=>$coupon,'selected'=>(in_array($coupon->id,$ids)?true:false));
		}
        foreach( Ad::where('status','=','enabled')->get() AS $ad )
        {
            $ads[] = array('data'=>$ad,'selected'=>(in_array($ad->id,$ad_ids)?true:false));
        }
		
		return view('staff.emails_edit',['email'=>$email,'coupons'=>$coupons, 'ads'=>$ads]);
	}
	
	
    public function coupons()
    {
		$coupons = Coupon::orderBy('id','desc')->paginate(25);
		
        return view('staff.coupons', ['coupons'=>$coupons]);
    }
	
	public function couponsDelete($id)
	{
		if( Auth::user()->role == 'admin' ) 
		{
			$coupon = Coupon::findOrFail($id);
			$coupon->delete();
		}
		return redirect('/staff/coupons');
	}
	
	public function couponsEdit($id, Request $request)
	{
		$coupon = Coupon::findOrFail( $id );
		if( $request->isMethod('post') )
		{

			foreach( $coupon->emails AS $email )
			{
				if( $email->sent != 1 )
				{
					Taggable::where([['email_id','=',$email->id],['taggable_id','=',$coupon->id],['taggable_type','=','App\Coupon']])->delete();
				}
			}
			
			if( $request->has('emails') )
			{
				foreach( $request->emails AS $link_email )
				{
					$insert = new Taggable;
					$insert->email_id = $link_email;
					$insert->taggable_id = $coupon->id;
					$insert->taggable_type = 'App\Coupon';
					$insert->save();
				}
			}
			
			if( Auth::user()->role == 'admin' )
			{
				$coupon->status = $request->status;
			}
			elseif ( env('APP_STAFF_COUPON_STATUS') == 'disabled' )
			{
				$coupon->status = env('APP_STAFF_COUPON_STATUS');
			}
			else
			{
				$coupon->status = $request->status;
			}
			$coupon->title = $request->title;
			$coupon->description = $request->description;
			$coupon->small_print = $request->small_print;
			$coupon->barcode_begins = $request->barcode_begins;
			$coupon->barcode_ends = $request->barcode_ends;
			$coupon->barcode_type = $request->barcode_type;
			$coupon->barcode_value = $request->barcode_value;
			$coupon->save();
			
			$coupon = Coupon::findOrFail( $id );
			
			$request->session()->flash('alert-success', __('app.msg_coupon_updated'));
		}
		
		$choices = [];
		$choices['available'] = [];
		$choices['sent'] = [];
		$choices['ids'] = [];
		
		foreach( $coupon->emails AS $email )
		{
			if( $email->sent == 1 )
			{
				$choices['sent'][] = $email;
			}
			else
			{
				$choices['ids'][] = $email->id;
			}
		}
		
		foreach( Email::where('send_date','>=',Carbon::now()->toDateString())->get() AS $email2 )
		{
			if( $email2->sent == 1 ) continue;
			$choices['available'][] = array('data'=>$email2,'selected'=>(!in_array( $email2->id, $choices['ids'] )?false:true));
		}
		
		return view('staff.coupons_edit', ['coupon'=>$coupon, 'choices' => $choices]);
	}
	
	public function couponsCreate(Request $request)
	{
		if( $request->isMethod('post') )
		{
			$coupon = new Coupon;
			if( Auth::user()->role == 'admin' )
			{
				$coupon->status = $request->status;
			}
			elseif ( env('APP_STAFF_COUPON_STATUS') == 'disabled' )
			{
				$coupon->status = env('APP_STAFF_COUPON_STATUS');
			}
			else
			{
				$coupon->status = $request->status;
			}
			$coupon->title = $request->title;
			$coupon->description = $request->description;
			$coupon->small_print = $request->small_print;
			$coupon->barcode_begins = $request->barcode_begins;
			$coupon->barcode_ends = $request->barcode_ends;
			$coupon->barcode_type = $request->barcode_type;
			$coupon->barcode_value = $request->barcode_value;
			$coupon->save();
			
			if( $request->has('emails') )
			{
				foreach( $request->emails AS $link_email )
				{
					$insert = new Taggable;
					$insert->email_id = $link_email;
					$insert->taggable_id = $coupon->id;
					$insert->taggable_type = 'App\Coupon';
					$insert->save();
				}
			}
			
			$request->session()->flash('alert-success', __('app.msg_coupon_created'));
			return redirect('/staff/coupons/edit/'.$coupon->id);
		}
		
		$choices = [];
		$choices['available'] = [];
		
		foreach( Email::where('send_date','>=',Carbon::now()->toDateString())->orWhere([['send_date','<',Carbon::now()->toDateString()],['sent','=',0]])->get() AS $email )
		{
			if( $email->sent == 1 ) continue;
			$choices['available'][] = $email;
		}

		return view('staff.coupons_create', ['choices'=>$choices]);
	}
}
