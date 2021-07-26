@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($images as $image)
            <div class="card mt-3 ">
                <div class="card-header">
                    <div class="container-avatar" >
                        <div class="row">
                            <div class="col-6">
                                {{-- Mostramos la foto de perfil del usuario --}}
                                <img style="width: 35px; height: 35px; border-radius: 900px; overflow: hidden;" src="{{ route('user.avatar',['filename' => $image->user->avatar]) }}">
                                &nbsp;
                                {{-- Cremoa un link al perfil del user --}}
                                <a href="{{route('profile', ['id' => $image->user->id])}}">
                                    {{ "@". $image->user->nick }}
                                 </a>
                            </div>
                            <div class="col-6">
                                {{-- Borrar imagen --}}
                                @if ( $image->user_id == \Auth::user()->id )
                                    <a href=""><button class="btn btn-success">Actualizar</button></a>
                                    <a href=""><button class="btn btn-danger">Eliminar</button></a>
                                @endif
                            </div>
                        </div>
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
                            <img src="{{ asset('img/dislike.png')  }}"  data-id="{{$image->id }}"  class="btn-dislike" alt="">
                        {{-- {{ count($image->likes)  }} --}}
                        @endif
                        {{-- <div>{{ count($image->likes)}}</div> --}}



                    </div>


                    {{-- Comments  --}}
                    <div class="comment" style="margin-left: 50px">
                        <a href="{{route('image.detail', ['id' => $image->id])}}" >
                            <img src="{{ asset('img/speech-bubble-5-32.png') }}" alt="">
                            {{-- <div>{{ count($image->comments)}}</div> --}}
                        </a>
                    </div>

                    {{-- Resetea los cajas flotantes --}}
                    <div class="reset"></div>

                    <div class="description">
                        <span><b>{{'@'.$image->user->nick .' : '}}</b>{{$image->description}}</span>
                    </div>
                </div>
            </div>

              @endforeach
        </div>
    </div>
</div>
@endsection
