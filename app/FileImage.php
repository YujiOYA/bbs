<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileImage extends Model
{
    protected $fillable = ['file_name'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
