<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\profile;
class speciality extends Model
{
    use HasFactory;


    public function profile(){
        return $this->hasMany(profile::class);
    }
}
