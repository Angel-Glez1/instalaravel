            @foreach ($images as $image)
            <div class="card mt-3 ">
                <div class="card-header">
                    <div class="container-avatar" >
                        {{-- Mostramos la foto de perfil del usuario --}}
                            <img style="width: 35px; height: 35px; border-radius: 900px; overflow: hidden;"
                            src="{{ route('user.avatar',['filename' => $image->user->avatar]) }}">

                        &nbsp;

                        {{-- Cremoa un link al perfil del user --}}
                    <a href="{{ route('image.detail', ['id' => $image->id]) }}">{{ "@". $image->user->nick }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="imagen-control">
                        <img src="{{ route('image.file', ['filename' => $image->imagen_paht]) }}" alt="">
                    </div>

                    {{-- Likes --}}
                    <div class="likes">
                        <?php $user_like = false; ?>

                        @foreach ($image->likes as $like)
                        @if ($like->user->id == Auth::user()->id )
                        <?php $user_like = true;  ?>
                        @endif
                        @endforeach

                        @if ($user_like)
                            <img src="{{ asset('img/like.png')  }}" data-id="{{$image->id }}" class="btn-like" alt="">
                            @else
                            <img src="{{ asset('img/dislike.png')  }}"  data-id="{{$image->id }}" class="btn-dislike" alt="">
                        {{-- {{ count($image->likes)  }} --}}
                        @endif
                        {{ count($image->likes)}}



                    </div>


                    {{-- Comments  --}}
                    <div class="comment" style="margin-left: 50px">
                            <img src="{{ asset('img/speech-bubble-5-32.png')  }}" alt="">
                            {{ count($image->comments)}}
                    </div>

                    {{-- Resetea los cajas flotantes --}}
                    <div class="reset"></div>

                    <div class="description">
                        <span>{{"@". $image->user->nick }}</span>
                        <p>{{$image->description }}</p>
                    </div>
                </div>
            </div>
@endforeach
