<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization,X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database=new Database();
$db = $database->connect();

$categoryObj=new Category($db);

$data=json_decode(file_get_contents("php://input"));

$categoryObj->category=$data->category;

if($categoryObj.create())
{
    echo json_encode(
        array('message' => 'Category Created')
    );
} else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );
}

