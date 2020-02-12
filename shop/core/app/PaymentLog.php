<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{

    protected $table = 'payment_logs';

    protected $guarded = [''];

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function paymentLogImage()
    {
        return $this->hasMany(PaymentLogImage::class,'payment_log_id');
    }

}
