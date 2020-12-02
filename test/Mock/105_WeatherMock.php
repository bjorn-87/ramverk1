<?php

namespace Bjos\Weather;

/**
 * A mock class.
 * @SuppressWarnings("unused")
 */
class WeatherMock extends Weather
{
    public function getWeather(string $lat = null, string $lon = null)
    {
        $data = [
            0 => [
                'lat' => 67.13,
                'lon' => 20.66,
                'date' => '27 Nov 2020',
                'temp_min' => -10,
                'temp_max' => -5.12,
                'wind_speed' => 1.31,
                'weather' => 'mulet',
                'icon' => '04d',
            ]
        ];

        return $data;
    }

    public function getHistory(string $lat = null, string $long = null)
    {
        //var_dump($url);
        $data = [
            0 => [
                'lat' => 67.13,
                'lon' => 20.66,
                'date' => '26 Nov 2020',
                'temp' => -7,
                'wind_speed' => 2.6,
                'weather' => 'klar himmel',
                'icon' => '01n',
            ],
        ];

        return $data;
    }
}
