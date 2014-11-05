<?php

$startTime = microtime(true);

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . "../../imagick-demos.conf.php";
require __DIR__ . '/../src/bootstrap.php';


\Intahwebz\Functions::load();

register_shutdown_function('fatalErrorShutdownHandler');
set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');


$routesFunction = function(\FastRoute\RouteCollector $r) {

    $categories = '{category:Imagick|ImagickDraw|ImagickPixel|ImagickPixelIterator|Tutorial}';

    //Category indices
    $r->addRoute(
        'GET',
        "/$categories",
        [\ImagickDemo\Controller\Page::class, 'setupCatergoryDelegation']
    );

    //Category + example
    $r->addRoute(
        'GET',
        "/$categories/{example:[a-zA-Z]+}",
        [\ImagickDemo\Controller\Page::class, 'setupExampleDelegation']
    );

    //Images
    $r->addRoute(
        'GET',
        "/image/$categories/{example:[a-zA-Z]+}",
        [\ImagickDemo\Controller\Page::class, 'getImageResponse']
    );

    $r->addRoute(
        'GET',
        "/customImage/$categories/{example:[a-zA-Z]*}",
        'setupCustomImageDelegation'
    );
    
    $r->addRoute('GET', '/info', [\ImagickDemo\Controller\ServerInfo::class, 'createResponse']);
    $r->addRoute('GET', '/', [\ImagickDemo\Controller\Page::class, 'setupRootIndex']);
};

$injector = bootstrapInjector(
    $libratoKey, 
    $libratorUsername,
    $statsSourceName
);
$response = servePage($injector, $routesFunction);


if ($response != null) {
    $response->send();
}


if (php_sapi_name() === 'fpm-fcgi') {
    fastcgi_finish_request();
}

//Everything below here should never affect user time.
$time = microtime(true) - $startTime;
$asyncStats = $injector->make('Stats\AsyncStats');
$asyncStats->recordTime(
    \ImagickDemo\Queue\ImagickTaskRunner::event_pageGenerated,
    $time
);