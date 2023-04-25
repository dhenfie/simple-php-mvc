<?php
session_start();
ini_set('display_errors', 1);

require '../vendor/autoload.php';
require '../config/Routes.php';

$app = \System\Routing\Route::launch();
echo $app;

