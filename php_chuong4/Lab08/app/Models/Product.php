<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id'];

    // Quan hệ ngược lại: 1 Product thuộc về 1 Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
