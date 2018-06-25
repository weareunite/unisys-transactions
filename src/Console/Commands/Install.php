<?php

namespace Unite\Transactions\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unisys-api:transactions:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install transactions module to Unisys API';

    /*
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing ...');

        $this->install();

        $this->info('UniSys module was installed');
    }

    private function install()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Transactions\\TransactionsServiceProvider'
        ]);

        $this->call('migrate');
    }
}