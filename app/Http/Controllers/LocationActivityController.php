<?php

namespace App\Http\Controllers;

use App\Models\LocationActivities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationActivityController extends HomeController
{
    public function show () {
        try {
            $location_activities = LocationActivities::select(
                'id',
                'name',
                'created_at',
                'updated_at'
            )->get();

            return view('backend.locations.activities', compact('location_activities'));
        } catch (\Exception $exception) {
            return view('backend.error');
        }
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'type'=>'validation', 'content' => $validator->errors()->toArray()]);
        }
        try {
            unset($request['id']);
            $request->merge(['created_by' => Auth::id()]);

            LocationActivities::create($request->all());

            return response(['case' => 'success', 'title' => 'Success!', 'content' => 'Successful!']);
        } catch (\Exception $exception) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'Sorry, something went wrong!']);
        }
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:100'],
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'type'=>'validation', 'content' => $validator->errors()->toArray()]);
        }
        try {
            $id = $request->id;
            unset($request['id'], $request['_token']);

            $request->merge(['updated_by' => Auth::id()]);

            LocationActivities::where(['id'=>$id])->update($request->all());

            return response(['case' => 'success', 'title' => 'Success!', 'content' => 'Successful!']);
        } catch (\Exception $exception) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'Sorry, something went wrong!']);
        }
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
            LocationActivities::where(['id' => $request->id])->whereNull('deleted_by')->update(['deleted_by' => Auth::id(), 'deleted_at' => Carbon::now()]);

            return response(['case' => 'success', 'title' => 'Success!', 'content' => 'Successful!', 'id' => $request->id]);
        } catch (\Exception $e) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'An error occurred!']);
        }
    }
}
