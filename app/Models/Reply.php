<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment_id', 'name', 'reply'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
