<?php

namespace Unite\Transactions\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'transaction_sources';

    protected $fillable = [
        'type', 'name', 'short_name', 'iban', 'bic', 'swift', 'description',
    ];

    const TYPE_BANK_ACCOUNT = 'bank-account';
    const TYPE_CASH_DESK    = 'cash-desk';

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getTypes()
    {
        return [
            self::TYPE_BANK_ACCOUNT,
            self::TYPE_CASH_DESK,
        ];
    }

    public function isBankAccount()
    {
        return ($this->type === self::TYPE_BANK_ACCOUNT);
    }
}
