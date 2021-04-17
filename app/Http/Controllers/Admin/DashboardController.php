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
      $pageConfigs = ['pageHeader' => true];

      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],
      ];

      $params = [
          "pageConfigs" => $pageConfigs,
          "breadcrumbs" => $breadcrumbs,
      ];

      return view('pages.dashboard.index', $params);
    }
}
