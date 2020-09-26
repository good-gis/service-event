<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/bootstrap.php';

use API\Controllers\EventAPIController;

ini_set( 'html_errors' , 0 );
$eventAPIController = new EventAPIController();
$eventAPIController->run();