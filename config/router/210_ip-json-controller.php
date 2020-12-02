<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "Validate ip Json.",
            "mount" => "ip-json",
            "handler" => "\Bjos\Validate\IpJsonController",
        ],
    ]
];
