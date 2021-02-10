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
        $cities = City::all();

        $dataFavorite = [];
        $dataUnfavorite = [];
        foreach ($cities as $city)
        {
            $cityData = Cache::get($city->code);
            $picture = $this->defineWeatherType($cityData);

            if ($city->favorite == true){
                $dataFavorite[$city->code] = array_merge($cityData,['favorite' => $city->favorite,'picture' => $picture]);
            } else {
                $dataUnfavorite[$city->code] = array_merge($cityData,['favorite' => $city->favorite,'picture' => $picture]);
            }
        }
        $data = array_merge($dataFavorite,$dataUnfavorite);

        return view('city.index',
            ['data' => $data]
        );

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
        $city = City::where('code',$code)->first();;

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

    protected function defineWeatherType($cityData)
    {
        if (isset($cityData['conditions']) && !empty($cityData['conditions']))
        {
            if (in_array($cityData['conditions'][0]['text'],['Fog','Haze','Smoke'])) {
                $picture = 'images/mist.PNG';
            }
            elseif (stripos($cityData['conditions'][0]['text'],'Rain') !== false){
                $picture = 'images/rain.PNG';
            }
            elseif (stripos($cityData['conditions'][0]['text'],'Snow') !== false) {
                $picture = 'images/snow.PNG';
            }
            else {
                $picture = 'images/undefined.PNG';
            }
        }
        else
        {
            if ($cityData['clouds'][0]['text'] == 'Clear skies') {
                $picture = 'images/sun.PNG';
            }
            else {
                $picture = 'images/cloud.PNG';
            }
        }
        return $picture;
    }
}
