<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;

class addCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addCity {code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add new city to catalog';

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
        $city = new City;
        $city->code = $this->argument('code');
        $city->save();
        return 0;
    }
}
