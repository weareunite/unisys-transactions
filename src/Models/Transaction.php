<?php

namespace Unite\Transactions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use LogsActivity;

    protected $table = 'transactions';

    protected $fillable = [
        'type', 'source_id', 'destination_iban', 'amount', 'variable_symbol', 'specific_symbol', 'description', 'posted_at',
    ];

    const TYPE_CREDIT   = 'credit';
    const TYPE_DEBIT    = 'debit';
    const TYPE_CARD     = 'card';

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public static function getTypes()
    {
        return [
            self::TYPE_CREDIT,
            self::TYPE_DEBIT,
            self::TYPE_CARD,
        ];
    }
}
