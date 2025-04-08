<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/welcome2','welcome',)->name( 'welcome');

Route::get('develop', function(){
    return 'Welcome to Developments';
    })->name('develop.index');

Route::get('/develop/{develops}',function($develops){
    if($develops === '5'){
        return redirect()->route('develop.index');
    }
return 'Detalles del desarrollador'. $develops;
});



//Route::get('/dashboard', function () {
// Ejecucion del middleware, antes de devolver o mostrar una vista
//return view('dashboard');
// Tambien se puede ejecutarlo despues de devolver mmostrar una vista
//})->middleware('auth')->name('dashboard');

 Route::middleware('auth')->group(function () {
    
    ///Route::get('/dashboard', function () {
     //   return view('dashboard');
   // })->name('dashboard');

   Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });

//Ruta personalizada para llamar la funcion de index y mostrar los posteos
 Route::get('/posts',[PostController::class,'index'])->name('posts.index');
//Ruta personalizada para crear el registro en la BD de Possts
 Route::post('/posts',[PostController::class,'store'])->name('posts.store');
//Ruta personaliizada para Actualizar registro
 Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');

//Ruta para actualizar
 Route::patch('/posts/{post}',[PostController::class,'update'])->name('posts.update');
//Ruta para eliminar
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

require __DIR__.'/auth.php';
