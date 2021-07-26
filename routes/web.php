<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\UserController;
use App\Image;
use Illuminate\Routing\RouteRegistrar;

Route::get('/', function () {
    // $images = Image::all();

    // foreach ($images as $image) {
    //     echo $image->imagen_paht . '<br>';
    //     echo $image->description . '<br>';
    //     echo $image->user->name  . '<br>';
    //     echo $image->user->email . '<br>';
    //     foreach ($image->comments as $comentario) {
    //         echo "<div> El user que te comento es: " . $comentario->user->name . "</div>";
    //         echo $comentario->content  . '<br>';
    //     }
    //     echo 'Likes: ' .  count($image->likes);
    //     echo "<hr>";




    // }
    // return view('welcome');
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Ruta para  el controlador usuario
Route::get('/config', 'UserController@config')->name('config');
Route::get('/users/profiles/{search?}', 'UserController@getUsers')->name('user.index');
Route::get('/users/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::post('/user/edit', 'UserController@update')->name('user.uptade');


// RUTA IMAGENES
Route::get('/subir-imagen', 'ImageController@create')->name('image');
Route::get('/imagen/file/{filename}', 'ImageController@getImages')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/imagen/delete/{image_id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/update/{image_id}', 'ImageController@update')->name('image.update');
Route::post('/guardar-imagen', 'ImageController@save')->name('image.save');


// COMMENTS
Route::get('/commnet/delet/{id}', 'CommentController@delete')->name('commnet.delete');
Route::post('/comment/save', 'CommentController@save')->name('comment');


// Rutas de likes
Route::get('/like/{image_id}', 'LikeController@like' )->name('like.save');
Route::get('/likes/{id}', 'LikeController@index')->name('likes');
Route::get('/dislike/{image_id}', 'LikeController@dislike' )->name('like.delete');

