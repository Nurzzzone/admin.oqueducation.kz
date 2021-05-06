<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\CreateSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(10);
        $params = array_merge(['subjects' => $subjects], $this->getPageBreadcrumbs(['pages.subjects']));
        return view('pages.classes.subjects.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        $params = array_merge(['subject' => $subject], $this->getPageBreadcrumbs(['pages.subjects']));
        return view('pages.classes.subjects.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Subject\CreateSubjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $subject = Subject::create($request->validated());
            });
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('subjects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $params = array_merge(['subject' => $subject], $this->getPageBreadcrumbs(['pages.subjects']));
        return view('pages.classes.subjects.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Subject\UpdateSubjectRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        try {
            DB::transaction(function() use($request, $subject) {
                $subject->update($request->validated());
            });
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('subjects.index');
    }
}
