<?php
return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->get('/', [\App\Controllers\HomeController::class, 'index']);
    $r->get('/contacts', [\App\Controllers\ContactsController::class, 'testInterface']);
});