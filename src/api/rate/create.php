<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';

require_once '../objects/rate.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//instantiate database and user object
$database = new Database();
$dbConnection = $database->getConnection();

$rateEntity = new Rate($dbConnection);

//get posted data
$data = json_decode(file_get_contents("php://input"));

// print_r($data);
if (!empty($data->userId) && !empty($data->serviceProviderId) && !empty($data->rate)) {
    //TODO: add further validation if user and service provider exist.

    $rateEntity->serviceProviderId = $data->serviceProviderId;
    $rateEntity->userId = $data->userId;
    $rateEntity->rate = $data->rate;

    if ($rateEntity->createOrUpdate()) {
        http_response_code(201);

        echo json_encode(array("message" => "rating registered"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "unable rate"));
    }
    
}
else {
    http_response_code(400);//bad request
    echo json_encode(array("message" => "unable to rate. Invalid data"));
}

?>