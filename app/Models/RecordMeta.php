<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordMeta extends Model
{
    use HasFactory;

    /** fillable */
    protected $fillable = [
        'record_id',
        'key',
        'value',
    ];

    /** Relations */
    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
