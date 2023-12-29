<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /** fillable */
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'visibility',
    ];

    /** Relations */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
