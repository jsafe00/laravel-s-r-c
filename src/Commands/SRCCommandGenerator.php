<?php
namespace Safventure\laravelSRC\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SRCCommandGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:src {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Model-Repository-Service-Controller class';
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

        Artisan::call('make:service', [
            'name' => $this->argument('name')
        ]);

        Artisan::call('make:repository', [
            'name' => $this->argument('name')
        ]);

        Artisan::call('make:rscontroller', [
            'name' => $this->argument('name')
        ]);

        $this->info('CRUD Service-Repository-Controller successfully created');
    }
}
