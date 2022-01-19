<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\Details;

class CountryController extends Controller
{
    //

    public function index(){
        $countries = Country::all();
        return view('country',compact('countries'));
    }

    public function getCities(Request $request)
    {

        $country = Country::find($request->country_id);

        $cities = $country->cities;

        return response()->json([
            'cities' => $cities
        ]);
    }

    public function getAreas(Request $request)
    {

        $city = City::find($request->city_id);

        $areas = $city->areas;

        return response()->json([
            'areas' => $areas
        ]);
    }

    public function submitData(Request $request){

        $details = new Details();
        $details->country_id = $request->country_id;
        $details->city_id = $request->city_id;
        $details->area_id = $request->area_id;
        $details->save();

        return redirect()->back()->with('message','Data inserted successfully');
    }
}
