<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "Validate ip and get geolocation.",
            "mount" => "geo",
            "handler" => "\Bjos\GeoLocation\GeoLocationController",
        ],
    ]
];
