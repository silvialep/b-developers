<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'name', 'email', 'subject', 'content', 'meeting_date', 'read'];

    public function developers() {
        return $this->belongsTo(Developer::class);
    }
}
