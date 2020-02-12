<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $table = 'transaction_logs';

    protected $guarded = [''];

    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }
}
