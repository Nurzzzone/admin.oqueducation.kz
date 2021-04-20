<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get page breadcrumbs
     * @return array
     */
    protected function getPageBreadcrumbs(array $names, string $teacher = null): array
    {
        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [ ["link" => "/", "name" => "Home"]];

        foreach ($names as $name) {
            $breadcrumbs[] = ["name" => __('locale.'.$name)];
        }
        
        $teacher ? $breadcrumbs[] = ['name' => $teacher]: null;
        return ["pageConfigs" => $pageConfigs, "breadcrumbs" => $breadcrumbs];
    }
}
