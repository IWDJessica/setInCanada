<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/user.php';

// required headers
/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//instantiate database and user object
$database = new Database();
$dbConn = $database->getConnection();

$user = new User($dbConn);

//sanitize
$emailQuery = htmlspecialchars(strip_tags($_GET["email"]));
// print_r("email: " . $emailQuery); //debug

//query user byEmail
$stmt = $user->getByEmail($emailQuery);
$count = $stmt->rowCount();

if ($count > 0) {

    $userResult = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['firstName'] to
        // just $firstName only
        extract($row);

        
        $userResult = array(
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "created" => $created,
            "lastAccess" => $lastAccess,
        );
    }

    //set the status ok found
    http_response_code(200);

    //json format
    echo json_encode($userResult);
} else {
    //not found
    http_response_code(404);

    echo json_encode(array("message" => "no user found"));
}
