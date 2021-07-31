<?php

namespace App\Http\Controllers;

use App\Models\LocationAreas;
use Illuminate\Http\Request;

class LocationAreasController extends HomeController
{
    public function show () {
        try {
            $location_areas = LocationAreas::select(
                'id',
                'name',
                'created_at',
                'updated_at'
            )->get();

            return view('backend.locations.areas', compact('location_areas'));
        } catch (\Exception $exception) {
            return view('backend.error');
        }
    }

    public function add () {

    }

    public function update () {

    }

    public function delete () {

    }
}
