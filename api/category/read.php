<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instatiate blog post object
$category = new Category($db);

//bLOG POST QUERY
$result = $category->read();
//Get row count
$num = $result->rowCount();

//check if any posts
if($num > 0){
    //Post array
    $categories_arr =  array();
    $categories_arr['data'] =  array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = array(
            'id' => $id,
            'name' => $name
        );
        //Push to 'data'
        array_push($categories_arr['data'], $category_item);
    }
    //Turn to JSON & output
    echo json_encode($categories_arr);

}else{
    //No Posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );

}
