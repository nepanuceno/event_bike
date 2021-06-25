<?php

namespace App\Models;

use App\Models\EventImages;
use App\Models\EventVideos;
use App\Models\EventCategory;
use App\Models\EventModality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date_event', 'start_date', 'end_date', 'adress', 'modality_id', 'category','logo', 'event_notice'
    ];

    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'category_has_event', 'event_id', 'category_id')->withPivot('cost'); //Um evento possui muitas categorias(Inicante, Sub30, Master A ...)
    }

    public function modality()
    {
        return $this->belongsTo(EventModality::class); //Um evento pertence a uma modalidade
    }

    public function images()
    {
        return $this->hasMany(EventImages::class);
    }

    public function videos()
    {
        return $this->hasMany(EventVideos::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_has_events');
    }
}
