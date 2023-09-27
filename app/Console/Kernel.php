<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

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
            $users = \DB::table('users')->where('payment_status',0)->where('user_type',0)
                    ->select('firstname','lastname','email')->get();
            $users = json_decode($users);
            foreach($users as $user) {
                $email = $user->email;
                $data = array();
                $data['username'] = $user->firstname . ' ' . $user->lastname;
                Mail::send('emails.job_alert_scheduler', $data, function ($message) use ($email) {
                    $message->to($email)->subject('IIET Solutions - Job Alert');
                });
            }
        })->everyMinute(1, '8:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
