<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MasterCommand3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jaja:refreshprod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-Run all bullshit in prod';

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
        echo exec('php71 composer.phar update');
        echo exec('php71 composer.phar dump-autoload');
        echo exec('php71 artisan migrate:fresh --seed');
        echo exec('php71 artisan key:generate');
        echo exec('php71 artisan vendor:publish --tag=lfm_config');
        echo exec('php71 artisan vendor:publish --tag=lfm_public');
        echo exec('php71 artisan cache:clear');
        echo exec('clear');
        echo ' Warlock of Darkness[8]: Done ';
    }
}
