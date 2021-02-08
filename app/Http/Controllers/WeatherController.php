<?php


namespace App\Http\Controllers;


use App\Services\MetarServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Models\City;

class WeatherController extends Controller
{
    private $metarService;

    public function __construct(MetarServiceInterface $metarService)
    {
        $this->metarService = $metarService;
    }

    //public function fetch(string $code)
    public function fetch()
    {
        $cities = City::all();
        //dd($cities);
        foreach ($cities as $city)
        {
            try {
                $dataRaw = $this->metarService->getWeather($city->code);

                /*
                $data = [
                    'city' => $dataRaw['station']['name'],
                    'temperature' => $dataRaw['temperature']['celsius'],
                    'code' => $city->code
                ];
                */
                //dd($data);
                //return response()->json($data);

            } catch (\Exception $exception) {
                return response()->json(
                    [
                        'error' => $exception->getMessage()
                    ], Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        return redirect(route('cities.list'));


    }

    public function list()
    {
        $data = $this->metarService->all();
        return \response()->json($data);
    }
}
