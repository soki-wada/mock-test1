<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'price',
        'description',
        'image',
        'brand',
        'is_purchased'
    ];


    public function conditions()
    {
        return $this->hasOne(Condition::class);
    }
}
