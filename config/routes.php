<?php

// config/routes.php
use App\Controller\BlogController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('listBlogEntries', '/')
        ->controller([BlogController::class, 'listBlogEntries'])
    ;
};

?>