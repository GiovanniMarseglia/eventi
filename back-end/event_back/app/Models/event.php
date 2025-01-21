<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Event extends Model
{
    use HasFactory;

    public function meetings() :BelongsTo{
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

    protected $fillable =['title','description','color','start','end','meeting_id'];

}
