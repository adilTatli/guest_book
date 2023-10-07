<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sort = $request->input('sort', '');

        $users = $this->search($search);

        if (!empty($search)) {
            if ($sort === 'date_added_asc') {
                $users->orderBy('created_at', 'asc');
            } elseif ($sort === 'date_added_desc') {
                $users->orderBy('created_at', 'desc');
            } else {
                $users->orderByDesc('rating');
            }
        } else {
            $users->orderBy('created_at', 'desc');
        }

        $users = $users->paginate(25);

        return view('index', compact('users', 'search', 'sort'));
    }

    protected function search($search)
    {
        $query = User::query();

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        return $query;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'userName' => 'required|string',
            'email' => 'required|email',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = new User;
        $user->name = $validatedData['userName'];
        $user->email = $validatedData['email'];
        $user->review = $validatedData['review'];
        $user->rating = $validatedData['rating'];

        $user->save();

        return redirect()->route('index')->with('success', 'Ваш отзыв принят!');
    }
}
