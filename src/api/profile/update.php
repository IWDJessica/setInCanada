<?php

/**
 * includes
 * @author Barbara Zacchi <b_zacchi@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once  '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/profile.php';

header("Content-Type: application/json; charset=UTF-8");

//instantiate database and user object
$database = new Database();
$dbConn = $database->getConnection();

$profile = new Profile($dbConn);

//get posted data
$data = json_decode(file_get_contents("php://input"));
// print_r($data); //debug

if (!empty($data->firstName) && !empty($data->lastName)) {
    $profile->firstName = $data->firstName;
    $profile->lastName = $data->lastName;
    $profile->email = $data->email;
    $profile->phoneNumber = $data->phoneNumber;
    $profile->country = $data->country;
    //create user
   if ($profile->updateProfile()) {
        http_response_code(201);

        echo json_encode(array("message" => "user updated"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "unable to update user"));
    }

} else {
    //user data is incomplete
    http_response_code(400);

    echo json_encode(array("message" => "unable to update user. Data is incomplete"));
}

?>