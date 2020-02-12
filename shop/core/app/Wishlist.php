<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $guarded = [''];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
