<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function event()
    {
        return $this->belogsTo(Event::class);
    }
}
