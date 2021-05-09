<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\ClassService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\CreateClassRequest;
use App\Http\Requests\Classes\UpdateClassRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassesController extends Controller
{

    protected $service;


    public function __construct(ClassService $classService)
    {
        $this->service = $classService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::paginate(15);
        $params = array_merge(['classes' => $classes], $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $class = new Classes();
            $data = $this->service->prepareForHtml();
            $data['class'] = $class;
            $params = array_merge(compact('data'), $this->getPageBreadcrumbs(['pages.classes']));
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return view('pages.classes.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Classes\CreateClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassRequest $request)
    {
        try {
            $this->service->createClass($request->validated());
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }  
        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        $params = array_merge(['class' => $class], $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        $data = $this->service->prepareForHtml();
        $data['class'] = $class;
        $params = array_merge(compact('data'), $this->getPageBreadcrumbs(['pages.classes']));
        return view('pages.classes.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Classes\UpdateClassRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassRequest $request, Classes $class)
    {
        try {
            $this->service->updateClass($request->validated(), $class);
        } catch(ModelNotFoundException $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        try {
            $this->service->deleteClass($class);
        } catch(ModelNotFoundException $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()->route('classes.index');
    }
}
