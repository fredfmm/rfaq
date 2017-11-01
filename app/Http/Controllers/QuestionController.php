<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Http\Requests\SaveQuestionRequest;
use \App\Question;
use \App\Category;
use \App\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $questions = Question::orderBy('question_text');
        if ($search) {
            $questions = $questions->where('question_text', 'LIKE', '%' . $search . '%');
        }

        $questions = $questions->paginate(15)
                                 ->appends($request->input());

        return view('admin.questions.index', compact('questions', $questions));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.questions.form', compact('categories', $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveQuestionRequest $request)
    {
        DB::beginTransaction();
        try {
            $question = Question::create($request->all());
            $answer = Answer::create(array_merge(["question_id" => $question->id], $request->all()));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('questions.index')->withErrors("Error saving question to the database." . $e->getMessage());
        }
        
        return redirect()->route('questions.edit', $question)->with('success', 'Question successfuly created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::all();
        return view('admin.questions.form', ["question" => $question, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Request\SaveQuestionRequest  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(SaveQuestionRequest $request, Question $question)
    {
        // TO DO
        
        return redirect()->back()->with('success', 'Question '. $question->id . ' updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question '. $question->id .' deleted.');
    }
}
