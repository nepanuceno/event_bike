<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'category_has_event', 'category_id', 'event_id');
    }
}
