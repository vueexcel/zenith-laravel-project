<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Display version of the application in the footer of the dashboard. This
    | is not in the reference of the actual package, this is what version of
    | the application you are building is.
    |
    */

    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose whether new users/admins are allowed to register.
    | This will show up the Register button in the menu and allow access to the
    | Register functions in AuthController.
    |
    | By default the registration is open only on localhost.
    */
    'registration_open' => env('REGISTRATION_OPEN', env('APP_ENV') === 'local'),

    /*
    |--------------------------------------------------------------------------
    | Impersonating users
    |--------------------------------------------------------------------------
    |
    | Allowing admins to sign in as other users.
    | Update App/Http/Kernel class to enable this feature.
    */
    'impersonate' => env('IMPERSONATE', false),

    /*
    |--------------------------------------------------------------------------
    | Menu Logos
    |--------------------------------------------------------------------------
    */
    'logo_lg'   => '<b>Health & Safety</b>',
    'logo_mini' => '<b>H&S</b>',

    /*
    |--------------------------------------------------------------------------
    | Footer Credits
    |--------------------------------------------------------------------------
    |
    | By default this will be used for the copyright on the inside of the
    | admin panel. This will also output the current year so the copyright
    | stays up to date, you can easily override this inside the view itself.
    |
    */

    'credits' => 'Powered By: <a target="_blank" href="mailto:user@example.com">Inspired Technology</a>',

    /*
    |--------------------------------------------------------------------------
    | AdminLTE Theme
    |--------------------------------------------------------------------------
    |
    | You will be able to decide easily which theme you want to load for the
    | AdminLTE Dashboard template. There are multiple colors to choose from
    | that are already pre-built, or you can create your own as well. The
    | following themes are available by default:
    |
    | - skin-black-light
    | - skin-black
    | - skin-blue-light
    | - skin-blue
    | - skin-green-light
    | - skin-green
    | - skin-purple-light
    | - skin-purple
    | - skin-red-light
    | - skin-red
    | - skin-yellow-light
    | - skin-yellow
    |
    */

    'theme' => 'skin-blue',

    'report_groups' => [
        'A' => [
            'code' => 'CP & Dir',
            'department' => 'Corporate Planning & Directors Office',
            'groups' => [
                0 => [
                    'code' => 'A1???',
                    'department' => 'External Affairs'
                ],
                1 => [
                    'code' => 'A2???',
                    'department' => 'Corporate Planning'
                ],
                2 => [
                    'code' => 'A9???',
                    'department' => 'Directors'
                ]
            ]
        ],
        'B' => [
            'code' => 'HR Div',
            'department' => 'Human Resources',
            'groups' => [
                0 => [
                    'code' => 'B1???',
                    'department' => 'Personnel & Employee Relations'
                ],
                1 => [
                    'code' => 'B2???',
                    'department' => 'Personnel & Employee Relations'
                ],
                2 => [
                    'code' => 'B3???',
                    'department' => 'Health Safety'
                ],
                3 => [
                    'code' => 'B4???',
                    'department' => 'Administration & HR Systems'
                ],
                4 => [
                    'code' => 'B5???',
                    'department' => 'Organisation Development'
                ],
                5 => [
                    'code' => 'B6???',
                    'department' => 'Ex-Pats / TME Xfr'
                ],
                6 => [
                    'code' => 'B9???',
                    'department' => 'HR GM'
                ]
            ]
        ],
        'C' => [
            'code' => 'A&F Div',
            'department' => 'Accounts & Finance',
            'groups' => [
                0 => [
                    'code' => 'C1???',
                    'department' => 'Accounts & Finance'
                ],
                1 => [
                    'code' => 'C2???',
                    'department' => 'Accounting'
                ],
                2 => [
                    'code' => 'C3???',
                    'department' => 'Corporate Services'
                ],
                3 => [
                    'code' => 'C9???',
                    'department' => 'F&CS GM'
                ]
            ]
        ],
        'E' => [
            'code' => 'PC Div',
            'department' => 'Production Control',
            'groups' => [
                0 => [
                    'code' => 'E1???',
                    'department' => ''
                ],
                1 => [
                    'code' => 'E2???',
                    'department' => ''
                ],
                2 => [
                    'code' => 'E3???',
                    'department' => 'Plant Management'
                ],
                3 => [
                    'code' => 'E4???',
                    'department' => 'Supply Chain Management & Logistic'
                ],
                4 => [
                    'code' => 'E5???',
                    'department' => 'Parts Flow Management'
                ],
                5 => [
                    'code' => 'E6???',
                    'department' => ''
                ],
                6 => [
                    'code' => 'E7???',
                    'department' => ''
                ],
                7 => [
                    'code' => 'E8???',
                    'department' => ''
                ],
                8 => [
                    'code' => 'E9???',
                    'department' => 'PC GM'
                ],
                9 => [
                    'code' => 'L6???',
                    'department' => 'Plant Change'
                ],
            ]
        ],
        'F' => [
            'code' => 'QA Div',
            'department' => 'Quality Assurance',
            'groups' => [
                0 => [
                    'code' => 'F1???',
                    'department' => 'Mass Production Quality'
                ],
                1 => [
                    'code' => 'F2???',
                    'department' => 'Inspection Operations Line'
                ],
                2 => [
                    'code' => 'F3???',
                    'department' => ''
                ],
                3 => [
                    'code' => 'F4???',
                    'department' => ''
                ],
                4 => [
                    'code' => 'F5???',
                    'department' => 'Audit Operations'
                ],
                5 => [
                    'code' => 'F6???',
                    'department' => 'Project Engineering'
                ],
                6 => [
                    'code' => 'F7???',
                    'department' => ''
                ],
                7 => [
                    'code' => 'F8???',
                    'department' => 'Supplier Quality'
                ],
                8 => [
                    'code' => 'F9???',
                    'department' => 'QA GM'
                ]
            ]
        ],
        'I' => [
            'code' => 'P&W Div',
            'department' => 'Press & Weld',
            'groups' => [
                0 => [
                    'code' => 'I3???',
                    'department' => 'Weld'
                ],
                1 => [
                    'code' => 'I4???',
                    'department' => 'Press'
                ],
                2 => [
                    'code' => 'IC???',
                    'department' => 'Weld Maintenance & Engineering'
                ],
                3 => [
                    'code' => 'I9???',
                    'department' => 'Press & Weld GM'
                ],
                4 => [
                    'code' => 'L7???',
                    'department' => 'Facilities'
                ],
                5 => [
                    'code' => 'L8???',
                    'department' => 'Facilities Infrastructure'
                ],
            ]
        ],
        'J' => [
            'code' => 'T&R Div',
            'department' => 'Paint & Plastics',
            'groups' => [
                0 => [
                    'code' => 'J5???',
                    'department' => 'Paint'
                ],
                1 => [
                    'code' => 'J6???',
                    'department' => 'Plastics'
                ],
                2 => [
                    'code' => 'JA???',
                    'department' => 'Plastics Engineering'
                ],
                3 => [
                    'code' => 'JB???',
                    'department' => 'Plastics Maintenance'
                ],
                4 => [
                    'code' => 'JC???',
                    'department' => 'Paint Maintenance'
                ],
                5 => [
                    'code' => 'JD???',
                    'department' => 'Paint Engineering'
                ],
                6 => [
                    'code' => 'J9???',
                    'department' => 'Paint & Plastics GM'
                ]
            ]
        ],
        'G' => [
            'code' => 'Assy Div',
            'department' => 'Assembly',
            'groups' => [
                0 => [
                    'code' => 'G7???',
                    'department' => 'Assembly 1'
                ],
                1 => [
                    'code' => 'G8???',
                    'department' => ''
                ],
                2 => [
                    'code' => 'GA???',
                    'department' => 'Assembly Maintenance'
                ],
                3 => [
                    'code' => 'GB???',
                    'department' => 'Logistics Operations'
                ],
                4 => [
                    'code' => 'GC???',
                    'department' => ''
                ],
                5 => [
                    'code' => 'GF???',
                    'department' => 'Assembly Engineering'
                ],
                6 => [
                    'code' => 'GG???',
                    'department' => 'Assembly Engineering Projects'
                ],
                7 => [
                    'code' => 'GH???',
                    'department' => 'Zuno'
                ],
                8 => [
                    'code' => 'G9???',
                    'department' => 'Assembly GM'
                ],
            ]
        ],
        'K' => [
            'code' => 'K????',
            'department' => 'Mfg General',
            'groups' => [
                0 => [
                    'code' => 'K1???',
                    'department' => ''
                ],
                1 => [
                    'code' => 'K5???',
                    'department' => 'Central Maintenance'
                ],
                2 => [
                    'code' => 'K9???',
                    'department' => 'Mfg Directors'
                ]
            ]
        ],
        'L' => [
            'code' => 'MPD Div',
            'department' => 'Manufacturing & Project Development',
            'groups' => [
                0 => [
                    'code' => 'L1???',
                    'department' => 'TPS Group'
                ],
                1 => [
                    'code' => 'L2???',
                    'department' => 'Skills Development'
                ],
                2 => [
                    'code' => 'L3???',
                    'department' => 'Project'
                ],
                3 => [
                    'code' => 'L4???',
                    'department' => 'Cost & Productivity Planning'
                ],
                4 => [
                    'code' => 'L5???',
                    'department' => 'Parts Cost'
                ],
                5 => [
                    'code' => 'L9???',
                    'department' => 'MPD GM'
                ]
            ]
        ],
        'M' => [
            'code' => 'Burnaston',
            'department' => 'Burnaston',
            'groups' => [
                0 => [
                    'code' => 'M????',
                    'department' => ''
                ],
                1 => [
                    'code' => 'N1???',
                    'department' => ''
                ]
            ]
        ],
        'H' => [
            'code' => 'Deeside',
            'department' => 'Deeside',
            'groups' => [
                0 => [
                    'code' => 'H????',
                    'department' => 'Engine Other'
                ],
                1 => [
                    'code' => 'H1???',
                    'department' => 'General Affairs'
                ],
                2 => [
                    'code' => 'H25??',
                    'department' => 'Casting'
                ],
                3 => [
                    'code' => 'H28??',
                    'department' => 'ZR'
                ],
                4 => [
                    'code' => 'H3???',
                    'department' => 'QA'
                ],
                5 => [
                    'code' => 'H4???',
                    'department' => 'PC'
                ],
                6 => [
                    'code' => 'H5???',
                    'department' => 'Engineering'
                ],
                7 => [
                    'code' => 'H6???',
                    'department' => 'Maintenance'
                ],
                8 => [
                    'code' => 'H9???',
                    'department' => 'Engine Directors'
                ]
            ]
        ]
    ]
];
