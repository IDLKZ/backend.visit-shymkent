<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FirstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize app with migration and seeder';

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

                Artisan::call("migrate");
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\RoleSeeder']);
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\EventTypeSeeder']);
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\WeekdaySeeder']);
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\UserSeeder']);
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\SettingSeeder']);
                Artisan::call("db:seed",[ '--class' => 'Database\Seeders\PlaceTypeSeeder']);
                $this->info("Successfully migrated and seeded");
        }



        catch (\Exception $e){
            $this->error("Something went wrong. The error is " . $e->getMessage());
        }
    }
}
