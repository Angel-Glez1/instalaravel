<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{

    // Restirnge el acceso a los usuarios no logueados
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Muestra la vista para subir una nueva imagen
    public function create()
    {
        return view('image.create');
    }

    // Guarda la imagen que viene desde la vista
    public function save(Request $resquest)
    {

        // Validamos
        $this->validate(
            $resquest,
            [
                'description' => 'required',
                'image_paht' => 'required|image'
            ]
        );

        //Recuperamos y guardamos datos
        $imagen_paht = $resquest->file('image_paht');
        $description = $resquest->input('description');

        // Creamos un nuevo objeto de la clase Image
        $id = \Auth::user()->id;

        $objImagen = new Image();
        $objImagen->user_id = $id;
        $objImagen->description = $description;

        // Subir la imagen al storage para despues poderla ocupar
        if ($imagen_paht == true) {

            $image_name = time() . $imagen_paht->getClientOriginalName();
            Storage::disk('images')->put($image_name, File::get($imagen_paht));
            $objImagen->imagen_paht = $image_name;
        }

        $objImagen->save();

        return redirect()->route('home')->with([
            'message' => 'La foto se publico correctamene'
        ]);
    }

    // recupera una imagen del disco para mostrarlar
    public function getImages($filename)
    {

        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }


    // Me muestra una foto al dellate para poder commentarla
    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', ['image' => $image]);
    }

    // Eliminar una foto
    public function delete($image_id){
        $user = \Auth::user();


        $image = Image::find($image_id);
        // echo '<pre>';
        // print_r($image);
        // echo '</pre>';
        // var_dump($image->user_id);
        // var_dump($user->id);


        $comments = Comment::where('image_id', $image_id)->get();
        // echo '<pre>';
        // print_r($comments);
        // echo '</pre>';

        $likes = Like::where('image_id', $image_id)->get();
        // echo '<pre>';
        // print_r($likes);
        // echo '</pre>';
        // die();


        // Validar que soy el dueño
        if ($image->user_id === $user->id) {

            // Elimino esos comentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // Elimino los likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // Elimino ls ficheros
            Storage::disk('images')->delete($image->imagen_paht);


            // Elimino Imagen
            $image->delete();

            // return redirect()->route('home');

        }

        return redirect()->route('profile', ['id' => $user->id ]);
    }

    // Mostrar formularios para editar
    public function update($image_id){

        $user = \Auth::user();

        $image = Image::find($image_id);

        return view('image.update', ['image' => $image]);
    }

    public function saveUpdate(){

        
    }

}
