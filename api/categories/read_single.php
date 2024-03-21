<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database=new Database();
$db = $database->connect();

$categoryObj=new Category($db);

$result= $categoryObj->read();
$num=$result->rowCount();

$categoryObj->id = isset($_GET['id']) ? $_GET['id'] : die();

$categoryObj->read_single();

$category_arr= array(
    'id' => $categoryObj->id,
    'category' => $categoryObj->category

);

print_r(json_encode($category_arr));