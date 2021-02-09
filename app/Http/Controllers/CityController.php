<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all();

        //return redirect(route('weather.get', ['code' => $cities[0]->code]));

        $dataFavorite = [];
        $dataUnfavorite = [];
        $data = [];
        foreach ($cities as $city)
        {
            $cityData = Cache::get($city->code);
            if ($city->favorite == true){
                $dataFavorite[$city->code] = array_merge($cityData,['favorite' => $city->favorite]);
            } else {
                $dataUnfavorite[$city->code] = array_merge($cityData,['favorite' => $city->favorite]);
            }
            //$data[$city->code] = array_merge($cityData,['favorite' => $city->favorite]);

            //var_dump($cityData);
            //echo '<br>';
        }
        $data = array_merge($dataFavorite,$dataUnfavorite);
        //dd($data);


        return view('city.index',
            ['data' => $data]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, City $city)
    public function update($code)
    {
        //
        $city = City::where('code',$code)->first();;
        //dd($city);

        if ($city->favorite == false) {
            $city->favorite = true;
        } else {
            $city->favorite = false;
        }
        $city->save();

        return redirect(route('cities.list'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
