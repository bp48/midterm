<?php

header('Access-Control-Allow-Origin: *');  // Adjust as needed for specific origins
header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];



