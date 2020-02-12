<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

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
