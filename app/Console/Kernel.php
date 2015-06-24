<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{

        // TODO: Add to crontab
        // * * * * * php /home/martioo7/brushpoint/artisan schedule:run 1>> /dev/null 2>&1
		$schedule->command('inspire')
				 ->hourly();

        // create a backup of the databases (already in crontab)
        $schedule->exec('touch foo.txt')->everyFiveMinutes()->thenPing('http://www.brushpoint.com/clear-database');

        // email the database backup to my gmail account
        $schedule->command('brushpoint:backup-database')->dailyAt('2:30')->sendOutputTo('/home/martioo7/scheduler/')->emailOutputTo('the.one.martin@gmail.com');

        // set up file backup


        //
	}

}
