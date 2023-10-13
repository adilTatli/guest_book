<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAddRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(25);
        return view('index', compact('posts'));
    }



    public function create()
    {
        return view('index');
    }


    public function store(PostAddRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;

        Post::create($data);

        return redirect()->route('user.posts.index')->with('success', __('post.created'));
    }
}
