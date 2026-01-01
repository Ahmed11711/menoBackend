<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'status',
        'image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Menuo::class);
    }
}
