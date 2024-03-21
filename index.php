<?php

header('Access-Control-Allow-Origin: *');  // Adjust as needed for specific origins
header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$resource = trim($uri, '/'); 

$valid_resources = ['quotes', 'authors', 'categories'];
if (!in_array($resource, $valid_resources)) {
  http_response_code(404);
  echo json_encode(['error' => 'Invalid Resource']);
  exit;
}
//$operation = strtolower($method);