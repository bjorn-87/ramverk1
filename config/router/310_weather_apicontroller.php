<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "weather-information",
            "mount" => "weatherapi",
            "handler" => "\Bjos\Weather\WeatherApiController",
        ],
    ]
];
