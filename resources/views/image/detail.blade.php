@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mt-3 ">
                <div class="card-header">
                    {{-- Prube --}}
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
                                    <a href="{{ route('image.update', ['image_id' => $image->id]) }}"><button class="btn btn-success">Actualizar</button></a>
                                    <a href="{{ route('image.delete', ['image_id' => $image->id ] ) }}"><button class="btn btn-danger">Eliminar</button></a>
                                @endif
                                </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="imagen-control">
                        <img src="{{ route('image.file', ['filename' => $image->imagen_paht]) }}" alt="">
                    </div>

                    <div class="likes">
                        <a href="">
                            <img src="{{ asset('img/favorite-4-24.png')  }}" alt="">
                        </a>
                    </div>

                    <div class="comment">
                    <a href="">
                            <img src="{{ asset('img/speech-bubble-5-32.png')  }}" alt="">
                            {{ count($image->comments)}}
                        </a>
                    </div>
                    <div class="reset"></div>

                    <div class="description">
                        <span>{{"@". $image->user->nick }}</span>
                        <p>{{$image->description }}</p>
                    </div>

                <form action="{{ route('comment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}" >
                        <textarea class="form-control" name="content" placeholder="Has un comentario..." ></textarea>
                        {{ $errors->first('content')}}
                        <button class="btn btn-primary" type="submit">Enviar</button>
                </form>

                <h3>Comentarios</h3>

                {{-- Recorro los comentarios que tiene esa imagen --}}
                @foreach ($image->comments as $comment)
                <div class=" border-dark" >
                <p>
                {{-- Muestro el nickname del usurio que comento --}}

                {{-- Mostramos el comentario  --}}
                <span><a href="{{route('profile', ['id' => $comment->user_id])}}">
                    <b>{{'@'.$comment->user->nick. ' : '}}</b></a>{{$comment->content}} </span>

                {{-- Si es dueño del comentario tiene la opcion de eliminar dicho comentario --}}
                @if($comment->user_id == \Auth::user()->id)
                    <a href="{{ route('commnet.delete' , ['id' => $comment->id ]) }}" class="btn btn-danger">
                        Eliminar comentario
                    </a>
                </p>
                @endif
                @endforeach





            </div>
        </div>
    </div>
</div>
@endsection
