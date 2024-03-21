<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database=new Database();
$db = $database->connect();

$authorObj=new Author($db);

$result= $authorObj->read();
$num=$result->rowCount();

$authorObj->id = isset($_GET['id']) ? $_GET['id'] : die();

$authorObj->read_single();

$author_arr= array(
    'id' => $authorObj->id,
    'author' => $authorObj->author

);

print_r(json_encode($author_arr));