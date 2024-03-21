<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization,X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database=new Database();
$db = $database->connect();

$quoteObj=new Quote($db);

$data=json_decode(file_get_contents("php://input"));

$quoteObj->quote=$data->quote;
$quoteObj->author_id=$data->author_id;
$quoteObj->category_id=$data->category_id;

if($quoteObj.create())
{
    echo json_encode(
        array('message' => 'Quote Created')
    );
} else {
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
}

