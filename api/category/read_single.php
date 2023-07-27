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

//GET ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//get post
$category->read_single();

//create array
$category_arr = array(
    'id' => $category->id,
    'name' => $category->name
);

//Make JSON
print_r(json_encode($category_arr));