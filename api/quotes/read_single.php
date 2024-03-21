<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database=new Database();
$db = $database->connect();

$quoteObj=new Quote($db);

$result= $quoteObj->read();
$num=$result->rowCount();

$quoteObj->id = isset($_GET['id']) ? $_GET['id'] : die();

$quoteObj->read_single();

$quote_arr= array(
    'id' => $quoteObj->id,
    'quote' => $quoteObj->quote,
    'author_id' => $quoteObj->author_id,
    'category_id' => $quoteObj->category_id

);

print_r(json_encode($quote_arr));