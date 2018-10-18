<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HoloSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holo:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run holo seeder';

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
        // Artisan::call('db:seed', [
        //     '--class' => 'Namespace\Seeds\DatabaseSeeder'
        // ]);
        // $this->call(DatabaseSeeder::class);
        // $name = $this->ask('What is your name?');
        // if($name == 'farid')
        // {

        // }
    }
}
