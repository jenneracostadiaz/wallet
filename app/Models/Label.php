<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'visibility',
        'color',
        'icon',
        'order_column',
        'parent_id',
    ];

    /** sublabels */
    public function sublabels()
    {
        return $this->hasMany(Label::class, 'parent_id');
    }

    /** parent label */
    public function parent()
    {
        return $this->belongsTo(Label::class, 'parent_id');
    }

    /** Relations */
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
