<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/database.php';

require_once '../objects/favourite.php';

//instantiate database and favourite object
function createOrDelete($data, $delete) {
        
    $database = new Database();
    $dbConnection = $database->getConnection();

    $favEntity = new Favourite($dbConnection);

    if ((!empty($data->serviceProviderId) && is_numeric($data->serviceProviderId)) && 
    (!empty($data->userId) && is_numeric($data->userId))) {

        $favEntity->deleted = $delete;
        $favEntity->serviceProviderId = $data->serviceProviderId;
        $favEntity->userId = $data->userId;

        if ($favEntity->createOrUpdate()) {
            if ($delete == 0) {
                http_response_code(201); //created                
                echo json_encode(array("message" => "favourite registered"));
            }
            else if ($delete == 1) http_response_code(204); //no content
        } else {
            http_response_code(503); //server error
            echo json_encode(array("message" => "unable to favourite, something went wrong"));
        }

    } else {
        //bad data
        http_response_code(400);//bad request
        echo json_encode(array("message" => "invalid data"));
    }
}


?>