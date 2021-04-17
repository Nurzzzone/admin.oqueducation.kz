<?php

namespace App\Http\Controllers\Admin;

use App\Models\FreeClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreeClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freeClasses = FreeClass::all();
        $params = [
            'free_classes' => $freeClasses
        ];
        return view('pages.classes-free.index', array_merge($params, $this->getPageBreadcrumbs('classes_free')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get page breadcrumbs
     * @return array
     */
    private function getPageBreadcrumbs(string $name)
    {
        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
          ["link" => "/", "name" => "Home"],
          ["name" => __('locale.pages.' . $name)]
        ];
        return ["pageConfigs" => $pageConfigs, "breadcrumbs" => $breadcrumbs];
    }
}
