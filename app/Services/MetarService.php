<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use RuntimeException;

class MetarService implements MetarServiceInterface
{
    public function getWeather(string $icao, $refreshTime = self::REFRESH_TIME)
    {
        if (!Cache::has($icao)) {
            $request = Http::withOptions([
                'curl'   => array( CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false ),
                'verify' => false
            ])->withHeaders([
                'X-API-Key' => env('CHECKVX_TOKEN')
            ])->get('https://api.checkwx.com/metar/'.$icao.'/decoded');

            if (!$request->ok()) {
                throw new RuntimeException('Server error');
            }


            $data = $request->json('data')[0];

            //Redis::set('key:'.$icao, $icao);
            Cache::put($icao, $data, $refreshTime);
            //var_dump('from api');
            //return $data;
        }
        else {
            //var_dump('from cash');
            //return Cache::get($icao);
            $data = Cache::get($icao);
        }
        return $data;
    }

    public function all()
    {
        $keys = Redis::keys('*');

        $allItems = [];

        foreach ($keys as $key) {
            $cacheKey = Str::after($key, ':');
            $allItems[] = Cache::get($cacheKey);
        }

        $data = [];
        $dataCollection = collect($allItems);
        $dataCollection->each(function($item) use (&$data) {
            $data[] = [
                'temperature' => $item['temperature']['celsius'],
                'station' => $item['station']['name'],
                'humidity' => $item['humidity']['percent']
            ];
        });
        return $data;
    }
}
