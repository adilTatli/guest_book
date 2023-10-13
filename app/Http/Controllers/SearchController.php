<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\User;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $searchQuery = $request->input('search');

        $users = User::whereHas('posts', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%');
        })
            ->with('posts')
            ->paginate(25);

        return view('search.index', compact('users'));
    }
}
