<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
      return view('pages.dashboard.index', $this->getPageBreadcrumbs(['pages.dashboard']));
    }
}
