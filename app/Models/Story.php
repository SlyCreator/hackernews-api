<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = ["h_id","title","url","score","by","descendants","h_time"];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
