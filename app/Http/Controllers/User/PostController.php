<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAddRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->with('user')->orderBy('created_at', 'desc')->paginate(25);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostAddRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;

        Post::create($data);

        return redirect()->route('user.posts.index')->with('success', __('post.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostAddRequest $request, string $id): RedirectResponse
    {
        $post = Post::find($id);
        $data = $request->all();
        $post->update($data);

        return redirect()->route('user.posts.index')->with('success', __('post.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('user.posts.index')->with('success', __('post.deleted'));
    }
}
