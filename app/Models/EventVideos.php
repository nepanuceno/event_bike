<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventVideos extends Model
{
    use HasFactory;

    protected $fillable = ['url_event'];


    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
