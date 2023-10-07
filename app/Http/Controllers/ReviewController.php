<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'date_added_desc');

        if ($filter === 'name_and_email_asc') {
            $users = User::orderBy('name')
                ->orderBy('email')
                ->paginate(25);
        } elseif ($filter === 'date_added_asc') {
            $users = User::orderBy('created_at', 'asc')
                ->paginate(25);
        } elseif ($filter === 'date_added_desc') {
            $users = User::orderBy('created_at', 'desc')
                ->paginate(25);
        }

        return view('index', compact('users'));
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
