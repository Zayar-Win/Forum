<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $filters = request(['tag', 'query']); // array
        $questions = Question::with('user')
            ->latest()
            ->filter($filters)
            ->get();
        return inertia('Welcome', [
            'questions' => $questions
        ]);
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return inertia('QuestionDetail', [
            'question' => $question->load('user')
        ]);
    }

    public function create()
    {
        return inertia('QuestionCreate');
    }

    public function store()
    {
        request()->validate([
            'title' => "required | min:5",
            'body' => "required",
        ]);
        $data = request()->all();
        $question = new Question();
        $question->title = $data['title'];
        $question->body = $data['body'];
        $question->user_id = auth()->id(); //2
        $question->save();

        return redirect('/');
    }
}
