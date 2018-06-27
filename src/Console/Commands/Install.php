<?php

namespace Unite\Transactions\Console\Commands;

use Unite\UnisysApi\Console\InstallModuleCommand;

class Install extends InstallModuleCommand
{
    protected $moduleName = 'transactions';

    protected function install()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Transactions\\TransactionsServiceProvider'
        ]);

        $this->call('migrate');
    }
}