<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MasterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jaja:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-Run all bullshit';

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
     * @return mixed
     */
    public function handle()
    {
        // echo exec('php artisan serve');
        echo ' Wait a few minutes doctor ';
        echo ' > ';
        echo exec('composer update');
        echo exec('composer dump-autoload');
        echo exec('php artisan migrate:fresh --seed');
        echo exec('php artisan key:generate');
        echo exec('php artisan vendor:publish --tag=lfm_config');
        echo exec('php artisan vendor:publish --tag=lfm_public');
        echo exec('php artisan cache:clear');
        echo exec('clear');
        echo ' Warlock of Darkness[8]: Done ';
        echo exec('php artisan inspire');
    }
}
