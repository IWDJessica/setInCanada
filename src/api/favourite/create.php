<?php
/**
 * includes
 * @author RenanMiranda <r_miranda@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once '../config/cors.php';

require_once '_shared.php';

/**
 * http content-type json
 */
header("Content-Type: application/json; charset=UTF-8");

//get posted data
$data = json_decode(file_get_contents("php://input"));

// print_r($data);//tested
if ($_SERVER['REQUEST_METHOD'] == "POST") createOrDelete($data, 0);
else http_response_code(405);

?>