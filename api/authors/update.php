<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization,X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database=new Database();
$db = $database->connect();

$authorObj=new Author($db);

$data=json_decode(file_get_contents("php://input"));

$authorObj->id = $data->id; 

$authorObj->author=$data->author;

if($authorObj.update())
{
    echo json_encode(
        array('message' => 'Author Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Author Not Updated')
    );
}

