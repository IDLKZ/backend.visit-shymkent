<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backUp:DB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backing up Data Base';

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
        try {
            Artisan::call("backup:run --only-db");
            $this->info("Database saved successfully");
        }
        catch (\Exception $e){
            $this->error("Oops, something went wrong");
        }
    }
}
