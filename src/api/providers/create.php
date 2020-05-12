<?php
/**
 * includes
 * @author Barbara Zacchi <b_zacchi@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/provider.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//instantiate database and user object
$database = new Database();
$dbConn = $database->getConnection();

$provider = new Provider($dbConn);

//get posted data
$data = json_decode(file_get_contents("php://input"));
// print_r($data); //debug
// die();

if (!empty($data->firstName) &&
    !empty($data->lastName &&
        !empty($data->email))) {

    //service_provider
    $provider->firstName = $data->firstName;
    $provider->lastName = $data->lastName;
    $provider->email = $data->email;
    $provider->contactNumber = $data->contactNumber;
    $provider->businessName = $data->businessName;
    $provider->image = $data->image;
    $provider->status = 1;
    $provider->acceptTerms = $data->acceptTerms;
    $provider->acceptEmail = 0;
    $provider->created = date("Y-m-d H:i:s");
    // //service
    $provider->name = $data->serviceName;
    $provider->type = $data->serviceType;
    //service_details
    $provider->price = $data->price;
    $provider->service_hours = $data->serviceHours;
    $provider->attributes = $data->attributes;
    $provider->imageService = $data->imageService;
    //service_location
    $provider->street = $data->street;
    $provider->city = $data->city;
    $provider->province = $data->province;
    $provider->postalCode = $data->postalCode;
     
    //create provider
    if ($provider->getByEmail($provider->email)->rowCount() > 0) {
        http_response_code(409);

        echo json_encode(array("message" => "Vendor already exists"));
    } else if ($provider->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Vendor created"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "unable to create Vendor"));
    }

} else {
    //user data is incomplete
    http_response_code(400);

    echo json_encode(array("message" => "unable to create Vendor. Data is incomplete"));
}
