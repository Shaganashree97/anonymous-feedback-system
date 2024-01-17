<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();

        return response()->json(['feedbacks' => $feedbacks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $feedback = Feedback::create([
            'content' => $request->input('content'),
        ]);

        return response()->json(['feedback' => $feedback], 201);
    }
}
