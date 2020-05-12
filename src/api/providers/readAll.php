<?php
/**
 * includes
 * @author Barbara Zacchi <b_zacchi@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once  '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/provider.php';

header("Content-Type: application/json; charset=UTF-8");

//instantiate database and member object
$database = new Database();
$dbConn = $database->getConnection();

$provider = new Provider($dbConn);

//sanitize
$service = $_GET["service"];

$stmt = $provider->readAllProviders($service);
$count = $stmt->rowCount();
$result = array();
if($count > 0){
  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // extract row
      extract($row);

      array_push( $result, array(
        "id" => $id,
        "firstName" => $firstName,
        "lastName" => $lastName,
        "businessName" => $businessName, 
        "image" => $image,
        "email" => $email, 
        "contactNumber" => $contactNumber,
        "serviceName" => $serviceName,
        "serviceType" => $serviceType,
        "servicePrice" => $servicePrice,
        "serviceHours" => $service_hours,
        "serviceAttributes" => $serviceAttributes,
        "serviceImage" => $serviceImage,
        "street" => $street,
        "city" => $city,
        "province" => $province,
        "postalCode" => $postal_code
      )
      );
  }

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($result);
  
} else {
    // set response code - 404 Not found
    http_response_code(404);
    
    echo json_encode(array("message" => "No Service provider founded in this category"));
}
?>
