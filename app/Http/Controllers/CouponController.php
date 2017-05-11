<?php 

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use cURL;
use Carbon\Carbon;
use App\Subscriber;
use DB;
use Lava;

use App\Coupon;

class CouponController extends Controller {

	/*
		Coupons Homepage
		GET/POST
	*/
    public function lander(Request $request)
	{

		if( $request->isMethod('post') )
		{
			/*
				Form has been submitted.
				Send list ID and email address to Mad Mimi API.
			*/
			$url = env('MAD_MIMI_ENDPOINT') . '/audience_lists/'.$request->type.'/add?email='.$request->email;
			$response = cURL::post($url, ['api_key' => env('MAD_MIMI_KEY'), 'username' => env('MAD_MIMI_USR')]);
			/*
				Update local database.
			*/
			$subscriber = Subscriber::firstOrNew(['list'=>$request->type,'email'=>$request->email]);
			$subscriber->list = $request->type;
			$subscriber->status = 'active';
			$subscriber->save();
			/*
				Flash success message to end user.
			*/
			$request->session()->flash('alert-success', __('app.subscribed_flash', ['app'=>env('APP_NAME')]));
		}
		return view('welcome');
	}
	
	/*
		Coupons Unsubscribe
		GET/POST
	*/
	public function unsubscribe(Request $request)
	{
		if( $request->isMethod('post') )
		{
			/*
				Form has been submitted.
				Send list email address to Mad Mimi API to unsubscribe from all lists.
			*/
			$url = env('MAD_MIMI_ENDPOINT') . '/audience_lists/remove_all?email='.$request->email;
			$response = cURL::post($url, ['api_key' => env('MAD_MIMI_KEY'), 'username' => env('MAD_MIMI_USR')]);
			/*
				Mark email address as disabled on local database.
			*/
			Subscriber::where('email', $request->email)->update(['status'=>'disabled']);
			/*
				Flash success message to end user.
			*/
			$request->session()->flash('alert-success', __('app.unsubscribed_flash', ['app'=>env('APP_NAME')]));
		}
		return view('unsubscribe');
	}
	
	public function advertise()
	{
		$counts['total'] = Subscriber::count();
		$counts['males'] = Subscriber::where('list',env('MAD_MIMI_MALES'))->count();
		$counts['females'] = Subscriber::where('list',env('MAD_MIMI_FEMALES'))->count();
		$counts['families'] = Subscriber::where('list',env('MAD_MIMI_FAMILIES'))->count();
		
		$subscriptions = Subscriber::select(array(
							DB::raw('DATE(`created_at`) as `date`'),
							DB::raw('COUNT(*) as `count`')
						))
						->groupBy('date')
						->orderBy('date', 'ASC')
						->pluck('count', 'date');
						
		$totalCPM = $counts['total'] * env('APP_PER_SUBSCRIBER');
		$malesCPM = $counts['males'] * env('APP_PER_SUBSCRIBER');
		$femalesCPM = $counts['females'] * env('APP_PER_SUBSCRIBER');
		$familiesCPM = $counts['families'] * env('APP_PER_SUBSCRIBER');
		
		$blocks['top'] = $totalCPM * .40;
		$blocks['second'] = $totalCPM * .15;
		
		$blocks['males']['top'] = $malesCPM * .40;
		$blocks['males']['second'] = $malesCPM * .15;
		
		$blocks['females']['top'] = $femalesCPM * .40;
		$blocks['females']['second'] = $femalesCPM * .15;
		
		$blocks['families']['top'] = $familiesCPM * .40;
		$blocks['families']['second'] = $familiesCPM * .15;
		
						
		$lava = Lava::dataTable();
		
		$lava->addDateColumn('Day')
			 ->addNumberColumn('Subscribers');
			 
		Lava::AreaChart('Subscribers', $lava, [
			'backgroundColor' => '#fcfcfc',
			'legend' => [
				'position' => 'none'
			],
			'vAxis' => ['minValue' => 0]
		]);
		
		$bottomLine = 0;
		
		foreach( $subscriptions AS $date => $sub_count )
		{
			$newRow = $bottomLine + $sub_count;
			$lava->addRow([
				$date, $newRow
			]);
			$bottomLine = $bottomLine + $newRow;
		}
						
		return view('advertise', ['subscriptions'=>$subscriptions, 'counts' => $counts, 'blocks' => $blocks]);
	}
	
	public function coupon($id)
	{
		$coupon = Coupon::findOrFail($id);
		return view('coupon',['coupon'=>$coupon]);
	}
	
	public function contact(Request $request)
	{
		if( $request->isMethod('post') )
		{
			Mail::to( env('APP_CONTACT_FORM_EMAIL') )->send( new ContactForm( $request->all() ) );
		}
		return view('contact');
	}
}