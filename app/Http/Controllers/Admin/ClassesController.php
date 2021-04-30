<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\CreateClassRequest;
use App\Http\Requests\ClassesRequest;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::paginate(15);
        $params = array_merge(compact('classes'), $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = new Classes();
        $params = array_merge(compact('class'), $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassRequest $request)
    {
            $data = $request->validated();
            $class = new Classes($data);
            foreach ($data['questions'] as $questionKey => $question) {
                foreach ($data['questions'][$questionKey]['answers'] as $answerKey => $answers) {
                    $question = $class->questions()->make($data['questions'][$questionKey]);
                    // $question->fill(['class_id' => $class->id]);
                    $ans = $question->answers()->make($answers);
                    // $ans->fill(['question_id' => $question->id]);
                }
            }
            $class->push();
            return redirect()->route('classes.index');

            // foreach ($data['questions '] as $questionKey => $question) {
            //     foreach ($data['questions '][$questionKey]['answers'] as $answerKey => $answer) {
            //         $question = $class->questions()->make($data['questions '][$questionKey]);
            //         $question->answers()->make($data['questions '][$questionKey]['answers']);
            //     }
            // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Classes::findOrFail($id);
        $params = array_merge(compact('classes'), $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        $params = array_merge(compact('classes'), $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClassesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassesRequest $request, $id)
    {
        $class = Classes::findOrFail($id);
        if ($class->save()) {
            return redirect()
                    ->route('classes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        if ($class->delete()) {
            return redirect()
                    ->route('classes.index');
        }
    }
}
