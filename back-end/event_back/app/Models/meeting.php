<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable=[
        "name",
        "place",
        "description",
        "meeting_id",
    ];


    public function events() :HasMany{
        return $this->hasMany(Event::class);
    }
}
