<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class event extends Model
{
    use HasFactory;

    public function meetings() :HasMany{
        return $this->hasMany(meeting::class);
    }
}
