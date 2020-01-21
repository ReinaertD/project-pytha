<?php
// Required headers
header("Access-Control-Allow-Origin: localhost");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->stock) &&
    !empty($data->webshop)
) {
    $product->setName($data->name);
    $product->setPrice($data->price);
    $product->setStock($data->stock);
    $product->setWebshop($data->webshop);

    if ($product->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "product created"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "failed to create"));
    }
}
else {
    http_response_code(400);
    // incomplete data
    echo json_encode(array("message" => file_get_contents("php://input")));

}
