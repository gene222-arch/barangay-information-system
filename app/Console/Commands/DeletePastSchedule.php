<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeletePastSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:delete-past';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete scheduled that was finished';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Schedule::all()
            ->map(function ($schedule) {
                if (Carbon::parse($schedule->end)->isPast()) 
                {
                    $schedule->delete();
                }
            });
    }
}
