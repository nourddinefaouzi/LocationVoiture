<?php

    // Path to the autoload file and bootstrap file
    require __DIR__ . '/../vendor/autoload.php';

    // Load the Laravel application
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Handle the incoming request through the HTTP kernel
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    // Capture the request and response
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle(
        $request
    );

    // Send the response back to the browser
    $response->send();

    // Terminate the application
    $kernel->terminate($request, $response);
