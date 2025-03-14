<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view (view: 'posts');

    }

   
    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
      //  $message =  request('message');
      $request->validate([
        'message'=> ['required', 'min:8'],
      ]);
        Post::create([ 
          'message'=> $request->get('message'),
            'user_id' => auth()->id(),
        ]);
        return to_route('posts.index')->with('status',_('Post created sucessfully!'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
