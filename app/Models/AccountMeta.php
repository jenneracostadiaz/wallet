<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountMeta extends Model
{
    use HasFactory;

    /** fillable */
    protected $fillable = [
        'account_id',
        'key',
        'value',
    ];

    /** Relations */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
