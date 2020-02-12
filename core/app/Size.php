<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $guarded = [''];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
