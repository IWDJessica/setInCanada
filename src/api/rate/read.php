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
//query
$serviceProviderIdQuery = htmlspecialchars(strip_tags($_GET["serviceProviderId"]));

$statement = $rateEntity->getServiceProviderScore($serviceProviderIdQuery);
$count = $statement->rowCount();

if ($count > 0) {
    $rateResult = array();
    $rateSum = 0;

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $rateSum += $rate;
        $serviceProviderId = $service_provider_id;
    }
    $score = $rateSum / $count;
    $score = round($score);

    $rateResult = array(
                "serviceProviderId" => $serviceProviderId,
                "rate" => $score
    );

    //set response ok found
    http_response_code(200);
    echo json_encode($rateResult);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "rating not found"));
}

?>