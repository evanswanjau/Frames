<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function items()
    {
        return $this->belongsToMany(OrderItem::class,'order_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

}
