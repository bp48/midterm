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

if($num > 0) {
    $authors_arr = array();
    $authors_arr['data']=array();

    while($row=$result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item= array(
            'id' => $id,
            'author' => $author
            
        );

        array_push($authors_arr['data'], $author_item);
    }

    echo json_encode($authors_arr);
} else {
    echo json_encode(
        array('message'=> 'No Authors Found')
    );

}
