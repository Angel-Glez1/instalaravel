<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {

        $user= \Auth::user();
        $imagen_id = $request->input('image_id');
        $content = $request->input('content');

        $commets =  new Comment();
        $commets->user_id = $user->id;
        $commets->image_id = $imagen_id;
        $commets->content = $content;

        $commets->save();


        return redirect()->route('image.detail', ['id' => $imagen_id]);
    }


    // Eliminar un comentario
    public function delete($id)
    {

        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->route('image.detail', ['id' => $comment->image_id ]);    


    }


}
