<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image',
    ];

    //ひとつの投稿がひとつのユーザーに紐づく
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Commentsに対するhasManyメソッドを追加
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
