<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /** fillable */
    protected $fillable = [
        'name',
        'slug',
        'visibility',
        'color',
        'icon',
        'order_column',
        'parent_id',
    ];

    /** subcategories */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /** parent category */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /** Relations */
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
