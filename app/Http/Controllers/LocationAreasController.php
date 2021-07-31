<?php

namespace App\Http\Controllers;

use App\Models\LocationAreas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'content' => 'Id not found!']);
        }
        try {
            LocationAreas::where(['id' => $request->id])->whereNull('deleted_by')->update(['deleted_by' => 1, 'deleted_at' => Carbon::now()]);

            return response(['case' => 'success', 'title' => 'Success!', 'content' => 'Successful!', 'id' => $request->id]);
        } catch (\Exception $e) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'An error occurred!']);
        }
    }
}
