<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meeting extends Model
{
    use HasFactory;


    public function events(){
        return $this->belongsTo(event::class);
    }
}
