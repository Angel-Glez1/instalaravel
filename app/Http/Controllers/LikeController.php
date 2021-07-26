<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar likes
    public function index($id)
    {

        $images = like::where('user_id', $id);

        // $likes = Like::all();

        return view('like.likes', ['images' => $images]);
    }

    public function like($image_id)
    {
        // Reocoger los datos del usuario
        $user = \Auth::user();

        // Ver que no se repita el like
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        //Al usar count nos permite validar si es 0 ya que si es asi eso indica que no exite ese like en esa imagen
        if ($isset_like == 0)
         {
            // Instaciar un nuevo objeto del modelo like
            $objlike = new like();
            $objlike->user_id = $user->id;
            $objlike->image_id = (int)$image_id;

            // Guardar el la base datos
            $objlike->save();

            // Retornar una repuesta para que AJAX lo procese
            return response()->json(
                [
                    'like' => $objlike
                ]
            );
        }else{
            return response()->json(
                [
                'message' => 'El like ya exite'
                ]
            );
        }
    }

    public function dislike($image_id)
    {
        // Reocoger los datos del usuario
        $user = \Auth::user();

        // Ver que no se repita el like
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        //Al usar count nos permite validar si es 0 ya que si es asi eso indica que no exite ese like en esa imagen
        if ($isset_like) {

            // Elimiar like
            $isset_like->delete();

            // Retornar una repuesta para que AJAX lo procese
            return response()->json(
                [
                    'like' => $isset_like,
                    'menssaje' => 'has dado dislike'
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'El like ya exite'
                ]
            );
        }
    }



}
