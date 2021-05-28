<?php

namespace App\Models;

use App\Models\EventCategory;
use App\Models\EventModality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function category()
    {
        return $this->hasMany(EventCategory::class);
    }

    public function modality()
    {
        return $this->belongsTo(EventModality::class); //Um evento pertence a uma modalidade
    }
}
