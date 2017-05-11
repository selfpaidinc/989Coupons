<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Subscriber;
use App\User;

use Auth;

use cURL;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function staff()
	{
		$staff = User::orderBy('id','desc')->paginate(25);
		
		return view('admin.staff', ['staff'=>$staff]);
	}
	
	public function staffDelete($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect('/admin/staff');
	}
	
	public function staffCreate(Request $request)
	{
		if( $request->isMethod('post') )
		{
			if( User::where('email',$request->email)->first() )
			{
				$request->session()->flash('alert-danger', __('app.msg_staff_exists'));
				return view('admin.staff_create');
			}
			
			$staff = new User;
			$staff->role = $request->role;
			$staff->name = $request->name;
			$staff->email = $request->email;
			$staff->password = Hash::make( $request->password );
			$staff->save();

			
			$request->session()->flash('alert-success', __('app.msg_staff_created'));
			return redirect('/admin/staff/edit/'.$staff->id.'?create=1');
		}
		return view('admin.staff_create');
	}
	
	public function staffEdit($id, Request $request)
	{
		$staff = User::findOrFail($id);
		
		if( $request->isMethod('post') )
		{
			if( $staff->email != $request->email )
			{
				if( User::where([['id','!=',$staff->id],['email','=',$request->email]])->first() )
				{
					$request->session()->flash('alert-danger', __('app.msg_staff_exists'));
					return view('admin.staff_edit', ['staff'=>$staff]);
				}
			}
			
			$staff->role = $request->role;
			$staff->name = $request->name;
			if( $request->password )
			{
				$staff->password = Hash::make( $request->password );
			}
			$staff->save();
			$request->session()->flash('alert-success', __('app.msg_staff_updated'));
		}
		
		return view('admin.staff_edit', ['staff'=>$staff]);
	}
	
    public function subscribers()
    {
		$subscribers = Subscriber::orderBy('id','desc')->paginate(25);
		
        return view('admin.subscribers', ['subscribers'=>$subscribers]);
    }
	
	public function subscribersCreate(Request $request)
	{
		if( $request->isMethod('post') )
		{
			if( Subscriber::where([['list','=',$request->list],['email','=',$request->email]])->first() )
			{
				$request->session()->flash('alert-danger', __('app.msg_email_already_subscribed'));
				return view('admin.subscribers_create');
			}

			/*
				Add to new list
			*/
			$url = env('MAD_MIMI_ENDPOINT') . '/audience_lists/'.$request->list.'/add?email='.$request->email;
			$response = cURL::post($url, ['api_key' => env('MAD_MIMI_KEY'), 'username' => env('MAD_MIMI_USR')]);
			
			$subscriber = new Subscriber;
			$subscriber->status = $request->status;
			$subscriber->list = $request->list;
			$subscriber->email = $request->email;
			$subscriber->save();
			
			$request->session()->flash('alert-success', __('app.msg_subscriber_created'));
			return redirect('/admin/subscribers/edit/'.$subscriber->id.'?create=1');
		}
		return view('admin.subscribers_create');
	}
	
	public function subscribersEdit($id, Request $request)
    {
		$subscriber = Subscriber::findOrFail( $id );
		
		if( $request->isMethod('post') )
		{
			if( $subscriber->list != $request->list )
			{
				if( Subscriber::where([['list','=',$request->list],['email','=',$request->email]])->first() )
				{
					$request->session()->flash('alert-danger', __('app.msg_email_already_subscribed'));
					return view('admin.subscribers_edit', ['subscriber'=>$subscriber]);
				}
				/*
					Remove from list
				*/
				$url = env('MAD_MIMI_ENDPOINT') . '/audience_lists/'.$request->list.'/remove?email='.$request->email;
				$response = cURL::post($url, ['api_key' => env('MAD_MIMI_KEY'), 'username' => env('MAD_MIMI_USR')]);

				/*
					Add to new list
				*/
				$url = env('MAD_MIMI_ENDPOINT') . '/audience_lists/'.$request->list.'/add?email='.$request->email;
				$response = cURL::post($url, ['api_key' => env('MAD_MIMI_KEY'), 'username' => env('MAD_MIMI_USR')]);
			}
			
			$subscriber->status = $request->status;
			$subscriber->list = $request->list;
			$subscriber->email = $request->email;
			$subscriber->save();
			
			$request->session()->flash('alert-success', __env('app.msg_subscriber_updated'));
		}
		
        return view('admin.subscribers_edit', ['subscriber'=>$subscriber]);
    }
}
