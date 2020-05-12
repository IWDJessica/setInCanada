<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';

require_once '../objects/favourite.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//instantiate database and favourite object
$database = new Database();
$dbConnection = $database->getConnection();

$favEntity = new Favourite($dbConnection);

//query
$userIdQuery = htmlspecialchars(strip_tags($_GET["userId"]));

$statement = $favEntity->getUserFavourites($userIdQuery);
$count = $statement->rowCount();

if ($count > 0) {
    $favResult = array();
    
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        array_push($favResult, array(
            "serviceProviderId" => $service_provider_id,
            "userId" => $user_id,
            "updated" => $updated,
            "businessName" => $businessName,
            "serviceName" => $serviceName,
            "serviceType" => $serviceType
            //TODO: add service provider joined fields
        ));
    }

    //set response ok
    http_response_code(200);
    echo json_encode($favResult);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "favourite not found"));
}

?>