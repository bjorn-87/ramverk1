<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "TestRoute for GeoApiController.",
            "mount" => "testapi",
            "handler" => "\Bjos\GeoLocation\MockGeoApiController",
        ],
    ]
];
