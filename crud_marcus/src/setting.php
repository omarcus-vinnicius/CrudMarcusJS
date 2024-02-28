<?php


namespace src;

function setting(): \Slim\Container
{
    $setting = [
        'settings' => [
            'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
            'logError' => true,
            'logErrorDetails' => false,

        ],
    ];

    $setting = new \Slim\Container($setting);


    return $setting;

}


?>