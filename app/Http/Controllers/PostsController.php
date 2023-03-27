<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function create()
    {
        return view('new');
    }

    public function store(Request $request)
    {
        Post::create([
            'id_user' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('feed');
    }

    public function show()
    {
        $posts = $this->post->listAll();
        return view('feed', ['posts' => $posts]);
    }

    public function destroy($id)
    {
        return $this->post->validateDelete($id);
    }

    public function finish(int $id_post)
    {
        return $this->post->finish($id_post);
    }
}
