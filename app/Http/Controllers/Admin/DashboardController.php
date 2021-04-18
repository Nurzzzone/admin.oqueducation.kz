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
      return view('pages.dashboard.index', $this->getPageBreadcrumbs('dashboard'));
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
