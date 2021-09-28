<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->hasMany(Event::class); //Uma modalidade possui vários eventos
    }
}
