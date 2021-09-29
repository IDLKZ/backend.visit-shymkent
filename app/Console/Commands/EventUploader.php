<?php

namespace App\Console\Commands;

use App\Models\Cron;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EventUploader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update events from Eventum';

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
     * @return int
     */
    public function handle()
    {
        try{
            Cron::getLatestEvents(true);
            $this->info("Event Updated");
        }
        catch (\Exception $exception){
            $updatedTo = $now = Carbon::now()->format("Y-m-d") . "T" . Carbon::now()->format("H:i:s");
            $crons = Cron::latest()->first();
            if($crons){
                $updatedFrom = $crons->updateTo;
            }
            $cron = Cron::add(['updateFrom'=>$updatedFrom, 'updateTo'=>$updatedTo, 'totalCount'=>0]);

            $this->error("Nothing To Update");
        }
    }
}
