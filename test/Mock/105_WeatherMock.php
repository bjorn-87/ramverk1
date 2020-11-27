<?php

namespace Bjos\Weather;

/**
 * A mock class.
 */
class WeatherMock extends Weather
{
    public function getWeather(string $lat = null, string $lon = null)
    {
        $json = [
            'lat' => 67.13,
            'lon' => 20.66,
            'timezone' => 'Europe/Stockholm',
            'timezone_offset' => 3600,
            'daily' => [
                0 => [
                    'dt' => '27 Nov 2020',
                    'sunrise' => 1606465893,
                    'sunset' => 1606479541,
                    'temp' => [
                        'day' => -5.12,
                        'min' => -10,
                        'max' => -5.12,
                        'night' => -6.36,
                        'eve' => -8.35,
                        'morn' => -5.99,
                    ],
                    'feels_like' => [
                        'day' => -8.74,
                        'night' => -10.2,
                        'eve' => -12.22,
                        'morn' => -9.49,
                    ],
                    'pressure' => 1017,
                    'humidity' => 94,
                    'dew_point' => -7.62,
                    'wind_speed' => 1.31,
                    'wind_deg' => 217,
                    'weather' => [
                        0 => [
                            'id' => 804,
                            'main' => 'Clouds',
                            'description' => 'mulet',
                            'icon' => '04d'
                        ]
                    ],
                    'clouds' => 100,
                    'pop' => 0,
                    'uvi' => 0.06
                ]
            ]
        ];

        return $json;
    }

    public function getHistory(string $lat = null, string $long = null)
    {
        //var_dump($url);
        $data = [
            0 => [
                'lat' => 67.13,
                'lon' => 20.66,
                'timezone' => 'Europe/Stockholm',
                'timezone_offset' => 3600,
                'current' => [
                    'dt' => '26 Nov 2020',
                    'sunrise' => 1606379227,
                    'sunset' => 1606393367,
                    'temp' => -7,
                    'feels_like' => -11.72,
                    'pressure' => 1008,
                    'humidity' => 92,
                    'dew_point' => -7.96,
                    'uvi' => 0.06,
                    'clouds' => 0,
                    'visibility' => 10000,
                    'wind_speed' => 2.6,
                    'wind_deg' => 300,
                    'weather' => [
                        0 => [
                            'id' => 800,
                            'main' => 'Clear',
                            'description' => 'klar himmel',
                            'icon' => '01n',
                        ]
                    ],
                ],
            ],
        ];

        return $data;
    }
}
