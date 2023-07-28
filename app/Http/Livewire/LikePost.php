<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isliked;
    public $likes;

    //esta funciion es practicamente como un constructor de PHP
    //se ejeecutara cada que se llame esta instacia
    public function mount($post)
    {
        //cada vez que se mande a llamar comprobaremos si el usuario ha dado
        $this->isliked = $post->checkLike(auth()->user());
        $this->likes =  $post->likes->count(); 
    }

    //comprobar si ya se dio like
    public function like()
    {

        //este codigo fue sacado de likeContrroller(ya que es la misma logica)
        if ($this->post->checkLike(auth()->user())){
             //borrar like de usuario en este post
        auth()->user()->likes()->where('post_id', $this->post->id)->delete();
        $this->isliked = false;
        $this->likes--;

        return back();
        }else {
            $this->post->likes()->create([
                'user_id' =>auth()->user()->id
            ]);
            $this->isliked = true;
            $this->likes++;
    
            return back(); 
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
