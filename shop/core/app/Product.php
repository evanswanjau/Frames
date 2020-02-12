<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Size');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }




}
