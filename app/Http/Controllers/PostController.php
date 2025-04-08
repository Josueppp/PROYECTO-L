<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
    'posts' => Post::with('user')->latest()->get(),
]);

    }


   
    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
      //  $message =  request('message');
      $dataValidates= $request->validate([
     'message'=> ['required', 'min:8', 'max:255'],
    ]);
    //     Post::create([ 
    //       'message'=> $request->get('message'),
    //         'user_id' => auth()->id(),
    //     ]);


    //Generar un registro a atraves de una relacion hasmany
    // Primero accediendo al user desde el rquest, luego a post desde user y finalmente
    //  a create desde post, ahora solo pasar los datos

//OTRA FORMA DE INSERCION
    // @dump($dataValidates);
    // $request->user()->posts()->create([
    //     'message' => $request->get('message')
    // ]);
    $request->user()->posts()->create($dataValidates);
        return to_route('posts.index')->with('status',__('Post created sucessfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        // if(auth()->user()->id !=$post->user_id){
        //     abort(403);
        // }
        
        //return view ('posts/edit', compact('post'));
        $this->authorize('update',$post);
        return view('posts/edit',[
            'post'=> $post,
        ]);
        
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update',$post);
        $dataValidates = $request->validate([
            'message'=>['required','min:8','max:255'],
        ]);
        $post->UPDATE($dataValidates);

        return to_route('posts.index')->with('status',__('Post update sucessfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return to_route('posts.index')->with('status',__('Post delete sucessfully'));
    }
}
