<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Tag;
use App\Category;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::withCount('questions')
            ->orderBy('questions_count', 'DESC')
            ->limit(4)
            ->get();
        $categories = Category::all();
        $questions = Question::orderBy('id');

        $search = $request->query('search');
        $category_id = $request->query('category_id');
        if ($search) {
            $questions->where('question_text', 'LIKE', '%' . $search . '%');
        }
        if ($category_id) {
            $questions->where('category_id', '=', $category_id);
        }

        $questions = $questions->paginate(10)
                               ->appends($request->input());

        return view('index', compact('tags', 'categories', 'questions'));
    }
}
