<?php


namespace App\Services;


interface MetarServiceInterface
{
    const REFRESH_TIME = 3600;

    /**
     * Get weather from api service.
     *
     * @param string $icao
     * @param int $refreshTime
     * @return mixed
     */
    public function getWeather(string $icao, $refreshTime = self::REFRESH_TIME);
}
