<?php
return [
    'settings' => [
        'displayErrorDetails' => SLIM_DISPLAY_ERRORS, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => dirname(TEMPLATE_PATH),
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => LOG_PATH_FILE,
        ],
    ],
];
