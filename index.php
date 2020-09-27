<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/bootstrap.php';

use API\Controllers\EventApiController;

ini_set( 'html_errors' , 0 );
$eventAPIController = new EventApiController();
$eventAPIController->run();