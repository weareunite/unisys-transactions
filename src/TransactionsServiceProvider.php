<?php

namespace Unite\Transactions;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Unite\Transactions\Console\Commands\Install;

class TransactionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->commands([
            Install::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        if (! class_exists('CreateTransactionsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../database/migrations/create_transactions_tables.php.stub' => database_path("/migrations/{$timestamp}_create_transactions_tables.php"),
            ], 'migrations');
        }

        Event::subscribe(TransactionSubscriber::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
