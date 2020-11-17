<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "Validate ip and get geolocation.",
            "mount" => "geoapi",
            "handler" => "\Bjos\GeoLocation\GeoApiController",
        ],
    ]
];
