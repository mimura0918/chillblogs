<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Auth;
use App\Post;
use App\Comment;

class PostController extends Controller
{


    public function index(){

        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function show($id){

        $post = Post::find($id);

        $comments = Comment::where('post_id', $id)->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function store(PostRequest $request){

        $post = new Post;
        // インスタンスを作成する。
        $post->title   = $request->title;
        $post->body    = $request->body;
        $post->user_id = Auth::id();

        // インスタンスを保存しないといけない
        $post -> save();

        return redirect()->route('posts.index');
    }

    public function edit($id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        $post->title   = $request->title;
        $post->body    = $request->body;

        $post -> save();

        return redirect()->route('posts.index');
    }

    public function destroy($id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
