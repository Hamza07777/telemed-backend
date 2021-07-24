<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\speciality;
use App\Models\service;
use App\Models\experience;
use App\Models\user;

class profile extends Model
{
    use HasFactory;

    public function speciality(){
        return $this->belongsTo(speciality::class);
    }

    // public function service(){
    //     return $this->belongsTo(service::class);
    // }
    // public function experience(){
    //     return $this->belongsTo(experience::class);
    // }

    public function services(){
        return $this->hasMany(service::class);
    }
    public function experiences(){
        return $this->hasMany(experience::class);
    }

    public function user(){
        return $this->hasOne(user::class);
    }
}
