<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //funcion de relacion de los post con los comentarios
    //un post tiene muchos post
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //funcion para comprobar si un usuario ya dio like
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

}
