<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class meeting extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "place",
        "description",
    ];

    public function events() :BelongsTo{
        return $this->belongsTo(event::class);
    }
}
