@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Gente</h2>
        <form action="{{ route('user.index') }}" method="get" id="buscador">
            <div class="row">
                <div class="form-group col">
                    <input type="text"  id="search" class="form-control">
                </div>
                <div class="form-group col">
                    <input type="submit" value="Buscar" class="btn btn-secondary ">
                </div>
            </div>
            </form>
            {{-- Mostramos info del usurio --}}
            @foreach($users as $user)
            <div class="card mb-4">
                <div class="card-body h-auto">
                    <div class="row">

                        <div class="col-6">
                        <img style="width: 270px; height: 270px; border-radius: 900px; overflow: hidden;" src="{{ route('user.avatar',['filename' => $user->avatar]) }}">
                        </div>
                        <div class="col-6">
                            <br>
                            <br>
                            <p>
                                <b>Nombre: </b>
                                {{ $user->name }}
                            </p>
                            {{-- Enlace al perfil del usuario --}}
                            <p>
                                <b>NickName:</b>
                                <a href="{{route('profile', ['id' => $user->id])}}">{{ "@". $user->nick }}</a>
                            </p>

                            {{-- Email --}}
                            <p>
                                <b>Email: </b>
                                {{$user->email }}
                            </p>

                            {{-- NUmero de publicacion --}}
                            <p>
                                <b>N° Publicaciones: </b>
                                {{ count($user->images)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
