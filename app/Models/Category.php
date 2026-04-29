<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'level'];

    /**
     * Relationship: Get the immediate parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Scope: Load the entire category tree starting from root nodes.
     */
    public function scopeWithFullTree($query)
    {
        return $query->whereNull('parent_id')
            ->with('allChildren');
    }

    /**
     * Relationship: Get immediate child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Relationship: Get all descendants using recursive eager loading.
     */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * Recursive Logic: Get all parent categories (path to root).
     */
    public function ancestors()
    {
        $ancestors = collect();
        $current = $this;

        while ($current->parent) {
            $current = $current->parent;
            $ancestors->push($current);
        }

        return $ancestors->reverse();
    }

    /**
     * Get all leaf categories (categories with no children) recursively.
     */
    public function leafCategories()
    {
        $leafs = collect();

        if ($this->children->isEmpty()) {
            $leafs->push($this);
        } else {
            foreach ($this->children as $child) {
                $leafs = $leafs->merge($child->leafCategories());
            }
        }

        return $leafs;
    }

    /**
     * Determine if the category is a leaf (has no descendants).
     */
    public function isLeaf()
    {
        return $this->children->isEmpty();
    }

    /**
     * Accessor: Calculate the depth level of the current category.
     */
    public function getDepthAttribute()
    {
        $depth = 0;
        $current = $this;

        while ($current->parent) {
            $depth++;
            $current = $current->parent;
        }

        return $depth;
    }

    /**
     * Define relationship: Advertisements directly attached to this category.
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    /**
     * Get all advertisements from this category and all its subcategories.
     */
    public function allAdvertisements()
    {
        $categoryIds = $this->getAllDescendantIds()->push($this->id);

        return Advertisement::whereIn('category_id', $categoryIds);
    }

    /**
     * Recursively collect IDs of all descendant categories.
     */
    public function getAllDescendantIds()
    {
        $ids = collect();

        foreach ($this->children as $child) {
            $ids->push($child->id);
            $ids = $ids->merge($child->getAllDescendantIds());
        }

        return $ids;
    }

    /**
     * Model Boot Logic: Automatically calculate tree level on save.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if ($category->parent_id) {
                $category->level = $category->parent->level + 1;
            } else {
                $category->level = 1;
            }
        });
    }

    /**
     * Accessor: Check for existence of child categories.
     * Uses collection count to avoid extra database queries in loops.
     */
    public function getHasChildrenAttribute(): bool
    {
        return $this->children->count() > 0;
    }
}
