<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';

    protected $guarded = [''];

    public function user_details()
    {
        return $this->belongsTo(User::class,'user_name');
    }



}
