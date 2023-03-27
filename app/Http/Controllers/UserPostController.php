<?php

namespace App\Http\Controllers;

use App\Models\UserPost;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function store(Request $request, int $id_post)
    {
        UserPost::create([
            'id_user' => $request->user()->id,
            'id_post' => $id_post,
            'type' => $request->type,
        ]);

        return redirect()->route('feed');
    }

    public function show(Request $request)
    {
        $posts = UserPost::listAll($request->user()->id);
        return view('follow', ['posts' => $posts]);
    }
}
