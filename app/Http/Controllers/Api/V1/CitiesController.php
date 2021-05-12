<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Models\City;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (CitiesResource::collection(City::all()))
                                ->response()
                                ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}
