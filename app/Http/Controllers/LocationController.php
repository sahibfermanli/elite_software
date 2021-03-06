<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Currencies;
use App\Models\LocationActivities;
use App\Models\LocationAreas;
use App\Models\Locations;
use App\Models\PaymentTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationController extends HomeController
{
    public function show () {
        try {
            $locations = Locations::leftJoin('contracts', 'locations.contract_id', '=', 'contracts.id')
                ->leftJoin('location_areas as area', 'locations.area_id', '=', 'area.id')
                ->leftJoin('location_activities as activity', 'locations.activity_id', '=', 'activity.id')
                ->leftJoin('payment_types', 'contracts.payment_type_id', '=', 'payment_types.id')
                ->leftJoin('currencies', 'contracts.currency_id', '=', 'currencies.id')
                ->select(
                    'locations.id',
                    'locations.name as location',
                    'area.name as area',
                    'activity.name as activity',
                    'payment_types.name as payment_type',
                    'contracts.payment_type_id',
                    'contracts.payment_percent',
                    'contracts.payment_price',
                    'currencies.name as currency',
                    'locations.contract_id',
                    'contracts.name as contract',
                    'contracts.start_date',
                    'contracts.expiry_date',
                    'contracts.is_active',
                    'locations.created_at',
                    'locations.updated_at'
                )
                ->orderBy('locations.id', 'DESC')
                ->get();

            $areas = LocationAreas::select('id', 'name')->get();
            $activities = LocationActivities::select('id', 'name')->get();
            $payment_types = PaymentTypes::select('id', 'name')->get();
            $currencies = Currencies::select('id', 'name')->get();
            $contracts = Contracts::select('id', 'name')->get();

            return view('backend.locations.locations', compact('locations'));
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

            Locations::create($request->all());

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

            Locations::where(['id'=>$id])->update($request->all());

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
            Locations::where(['id' => $request->id])->whereNull('deleted_by')->update(['deleted_by' => Auth::id(), 'deleted_at' => Carbon::now()]);

            return response(['case' => 'success', 'title' => 'Success!', 'content' => 'Successful!', 'id' => $request->id]);
        } catch (\Exception $e) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'An error occurred!']);
        }
    }
}
