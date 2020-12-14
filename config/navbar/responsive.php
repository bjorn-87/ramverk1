<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                    [
                        "text" => "Kmom07-10",
                        "url" => "redovisning/kmom10",
                        "title" => "Redovisning för kmom10.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Validering",
            "url" => "validering",
            "title" => "Validera/lokalisera IP",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Validera IP(Kmom01)",
                        "url" => "ip",
                        "title" => "Validera IP",
                    ],
                    [
                        "text" => "Lokalisera IP(Kmom02)",
                        "url" => "geo",
                        "title" => "Lokalisera IP",
                    ],
                ],
            ],
        ],
        [
            "text" => "VäderInfo",
            "url" => "weather",
            "title" => "Väder",
        ],
        [
            "text" => "Api",
            "url" => "api",
            "title" => "Api",
        ],
        [
            "text" => "Böcker",
            "url" => "book",
            "title" => "Böcker",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Dokumentation",
                        "url" => "doc",
                        "title" => "Dokumentation anax",
                    ],
                    [
                        "text" => "Anax Dev",
                        "url" => "dev",
                        "title" => "Dev verktyg",
                    ],
                    [
                        "text" => "Styleväljare",
                        "url" => "style",
                        "title" => "Styleväljare",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
    ],
];
