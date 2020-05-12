<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/user.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//instantiate database and user object
$database = new Database();
$dbConn = $database->getConnection();

$user = new User($dbConn);

//get posted data
$data = json_decode(file_get_contents("php://input"));
// print_r($data); //debug

if (!empty($data->firstName) &&
    !empty($data->lastName &&
        !empty($data->email))) {

    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->created = date("Y-m-d H:i:s");
    $user->lastAccess = $user->created;

    //create user
    if ($user->getByEmail($user->email)->rowCount() > 0) {
        http_response_code(409);

        echo json_encode(array("message" => "user already exists"));
    } else if ($user->create()) {
        http_response_code(201);

        echo json_encode(array("message" => "user created"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "unable to create user"));
    }

} else {
    //user data is incomplete
    http_response_code(400);

    echo json_encode(array("message" => "unable to create user. Data is incomplete"));
}
