<?php
/**
 * includes
 * @author Barbara Zacchi <b_zacchi@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/user.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$dbConn = $database->getConnection();

$user = new User($dbConn);

// get post data
$data = json_decode(file_get_contents("php://input"));

$user->email = htmlspecialchars(strip_tags($data->email));
$user->password = htmlspecialchars(strip_tags($data->password));

if ($user->readOne()->rowCount() > 0) {
    // create array
    // set response code - 200 OK
    http_response_code(200);

   // make it json format
    echo json_encode(array("message" => "login success"));

} else {
    // set response code - 401 Unauthorized
    http_response_code(401);
    //access denied

    echo json_encode(array("message" => "access denied"));
}
