<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowerController extends Controller
{
    public function store(User $user)
    {
      //agregamos el usuario que presiono seguir a la lista de seguidores de un usuario
      $user->followers()->attach( auth()->user()->id);
   
      return back();
    }

    public function destroy(User $user)
    {
      //Eliminamos el usuario que presiono dejars seguir a la lista de seguidores de un usuario
       $user->followers()->detach(auth()->user()->id);
       
        return back();
    }
}
