<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "weather-information",
            "mount" => "weather",
            "handler" => "\Bjos\Weather\WeatherController",
        ],
    ]
];
