<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Email;

use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
		$schedule->call(function () {
			
			/*
				create jobs to send current newsletter
			*/
			
			
			/*
				create newsletters for next week
			*/
			$mail = new Email;
			$mail->status = 'disabled';
			$mail->sent = 0;
			$mail->send_date = Carbon::parse( new Carbon('next '.rtrim(env('APP_EMAIL_SEND_DAY'),"s ")) )->toDateString();
			$mail->list = env('MAD_MIMI_MALES');
			$mail->save();
			
			$mail = new Email;
			$mail->status = 'disabled';
			$mail->sent = 0;
			$mail->send_date = Carbon::parse( new Carbon('next '.rtrim(env('APP_EMAIL_SEND_DAY'),"s ")) )->toDateString();
			$mail->list = env('MAD_MIMI_FEMALES');
			$mail->save();
			
			$mail = new Email;
			$mail->status = 'disabled';
			$mail->sent = 0;
			$mail->send_date = Carbon::parse( new Carbon('next '.rtrim(env('APP_EMAIL_SEND_DAY'),"s ")) )->toDateString();
			$mail->list = env('MAD_MIMI_FAMILIES');
			$mail->save();
			
		})->weekly()->{env('APP_EMAIL_SEND_DAY')}()->at(env('APP_EMAIL_SEND_TIME'));
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
