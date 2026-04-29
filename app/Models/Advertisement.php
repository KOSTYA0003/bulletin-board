<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'images',
        'user_id',
        'category_id',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function canCreateInCategory($categoryId)
    {
        $category = Category::find($categoryId);

        return $category && $category->isLeaf();
    }

    public function scopeInCategory($query, $categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $categoryIds = $category->getAllDescendantIds()->push($categoryId);

            return $query->whereIn('category_id', $categoryIds);
        }

        return $query;
    }
}
