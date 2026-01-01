<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menuo extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
