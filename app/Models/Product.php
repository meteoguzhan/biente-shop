<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
