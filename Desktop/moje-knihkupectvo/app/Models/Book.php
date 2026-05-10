<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'author_id', 'price', 'original_price', 'discount',
        'description', 'image', 'status',
        'is_new', 'is_preorder', 'is_bestseller',
        'published_at', 'preorder_date',
        'language', 'binding', 'series', 'series_number', 'publisher', 'page_count',
        'gallery'
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_preorder' => 'boolean',
        'is_bestseller' => 'boolean',
        'published_at' => 'date',
        'preorder_date' => 'date',
        'price' => 'decimal:2',
        'page_count' => 'integer',
        'series_number' => 'integer',
        'gallery' => 'array',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function authorModel()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount > 0) {
            return round($this->price * (1 - $this->discount / 100), 2);
        }
        return $this->price;
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    // Pomocný atribút pre odhad času čítania
    public function getReadingTimeAttribute()
    {
        if (!$this->page_count || $this->page_count <= 0) {
            return null;
        }
        $hours = $this->page_count / 50;
        $low = floor($hours);
        $high = ceil($hours);
        if ($low == $high) {
            return $low . ' hodín';
        }
        return $low . '-' . $high . ' hodín čítania';
    }
}