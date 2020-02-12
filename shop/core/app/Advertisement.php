<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';

    protected $fillable = ['advert_type','advert_size','title','val1','val2','status','link','hit'];

}
