<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'rg',
        'cpf',
        'phone',
        'emergency_phone',
        'blood_type',
        'gender',
        'allergy',
        'health_problem',
        'take_medication',
        'user_id'
    ];

    public function user()
    {

        return $this->belongsTO(User::class);
    }

}

