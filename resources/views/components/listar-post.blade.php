@if ($posts->count())
    <div class="grid md:w-2/5 m-auto gap-8">
        @foreach ($posts as $post)
            <div class="container">
                <div class="mb-2 px-2">
                    <a href="{{ route('posts.index', $post->user->username) }}"
                        class="font-bold">{{ $post->user->username }}
                        <span class="mx-2 text-sm font-normal text-gray-600">
                            {{ $post->created_at->diffForHumans() }} </span>
                    </a>
                </div>

                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src={{ asset('uploads') . '/' . $post->imagen }} alt="Imagen del post {{ $post->titulo }}">
                </a>


                <div class="p-2 flex items-center gap-2">
                    @auth
                    
                    <livewire:like-post :post="$post" />

                        {{-- @if ($post->checkLike(auth()->user()))
                            <form method="POST" action="{{ route('posts.like.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <div class="mt-1">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @else
                            <form method="POST" id="likeForm" action="{{ route('posts.like.store', $post) }}">
                                @csrf
                                <div class="mt-1">
                                    <button id="likeButton" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @endif --}}

                    @endauth
                </div>

                <div class="px-2 ">
                    <p>{{ $post->descripcion }}</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center">No hay posts, sigue al alguien para poder mostrar sus posts</p>

@endif


