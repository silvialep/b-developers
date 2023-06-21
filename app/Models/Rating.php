<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'rating'];

    public function developers()
    {
        return $this->belongsTo(Developer::class);
    }
}
