<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $table = 'child_categories';

    protected $guarded = [''];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

}
