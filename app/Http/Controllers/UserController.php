<?php

namespace App\Http\Controllers;

// use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    // Restringe el acceso a usuarios no logueados
    public function __construct()
    {
        $this->middleware('auth');
    }



    // Return an view for user edit
    public function config()
    {
        return view('user.config');
    }


    // Acrualizar los datos del usurario
    public function update(Request $request)
    {
        // Recuperara datos del user identificado
        $user = \Auth::user();
        $id = $user->id;

        // Validar datos
        $this->validate($request,
        [
            'name' => 'required|string|max:255|unique:users,name,'.$id,
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
        ]);

        // Recuperar datos del los inputs
        $name = $request->input('name');
        $nick = $request->input('nick');
        $emial = $request->input('email');


        // Asignarle nuevos valores a propiedades del usuario ()
        $user->name = $name;
        $user->nick = $nick;
        $user->email = $emial;

        // Guardar foto de perfil en mi base de datos
        $avatar = $request->file('avatar');
        if($avatar)
        {
            // Asigno un nombre unico
            $foto_perfil = time().$avatar->getClientOriginalExtension();

            // Guardar lo en la carpeta temporal
            Storage::disk('users')->put($foto_perfil, File::get($avatar));

            // Asignarle el valor en la base de datos
            $user->avatar = $foto_perfil;
        }


        // Guardar en la base datos
        $user->update();

        return redirect()->route('config');


    }


    // Saco de la carpeta storage la foto de perfil del usuario
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id)
    {
        $user = User::find($id);

        return view('user.profile', [

            'user' => $user
        ]);

    }


    public function getUsers($search = null){

        if ($search != null) {

            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                          ->orwhere('name', 'LIKE', '%' . $search . '%')
                          ->orderby('id', 'desc')
                          ->paginate(5);

        } else {
            $users = User::OrderBy('id', 'desc')->paginate(5);

        }





        return view('user.index', ['users' => $users]);

    }


}
