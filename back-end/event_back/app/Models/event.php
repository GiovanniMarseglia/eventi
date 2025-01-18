<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class event extends Model
{
    use HasFactory;

    public function meetings() :BelongsTo{
        return $this->belongsTo(meeting::class);
    }
}
