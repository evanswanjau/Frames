<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
