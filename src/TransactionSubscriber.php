<?php

namespace Unite\Transactions;


use Carbon\Carbon;
use Unite\Transactions\Events\TransactionEvent;
use Unite\Transactions\Events\TransactionSaving;
use Unite\Transactions\Models\Transaction;

class TransactionSubscriber
{
    public function setDefaults(TransactionEvent $event)
    {
        if($event->transaction->exists === false) {
            if(!$event->transaction->posted_at) {
                $event->transaction->posted_at = Carbon::now();
            }

            if(!$event->transaction->type) {
                $event->transaction->type = Transaction::getDefaultType();
            }
        }
    }

    public function updateBalance(TransactionEvent $event)
    {
        if($event->transaction->exists === false) {
            $event->transaction->balance = $event->transaction->calculateBalanceBySource();

            $event->transaction->source->balance = $event->transaction->balance;
            $event->transaction->source->save();
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            [ TransactionSaving::class ],
            TransactionSubscriber::class . '@setDefaults'
        );

        $events->listen(
            [ TransactionSaving::class ],
            TransactionSubscriber::class . '@updateBalance'
        );
    }
}