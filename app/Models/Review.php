<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'name', 'comment'];

    public function developers()
    {
        return $this->belongsTo(Developer::class);
    }
}
