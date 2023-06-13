<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
