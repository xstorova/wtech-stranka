<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'price', 'original_price', 'discount',
        'description', 'image', 'category', 'status',
        'is_new', 'is_preorder', 'is_bestseller',
        'published_at', 'preorder_date'
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_preorder' => 'boolean',
        'is_bestseller' => 'boolean',
        'published_at' => 'date',
        'preorder_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount > 0) {
            return round($this->price * (1 - $this->discount / 100), 2);
        }
        return $this->price;
    }
}