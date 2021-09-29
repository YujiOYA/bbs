<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    protected $fillable = [
        'post_id',
        'confirm'
        ];
    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
