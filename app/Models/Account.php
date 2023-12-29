<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /** fillable */
    protected $fillable = [
        'name',
        'type',
        'color',
        'icon',
        'visibility',
        'order_column',
        'slug',
        'starting_balance',
        'currency_id',
    ];

    /** Relations */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
