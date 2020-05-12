<?php
/**
 * includes
 * @author Barbara Zacchi <b_zacchi@fanshaweonline.ca>
 * @copyright 2020 SetInCanada
 */
require_once  '../config/cors.php';
require_once '../config/database.php';
require_once '../objects/category.php';

header("Content-Type: application/json; charset=UTF-8");

//instantiate database and member object
$database = new Database();
$dbConn = $database->getConnection();

$category = new Category($dbConn);

$stmt = $category->readCategory();
$count = $stmt->rowCount();
$catResult = array();
if($count>0){
  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // extract row
      // this will make $row['firstName'] to
      // just $firstName only
      extract($row);

      array_push($catResult, array(
          "catId" => $catId,
          "catName" => $catName,
      )) ;
  }

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($catResult);
  
} else {
    // set response code - 404 Not found
    http_response_code(404);
    
    echo json_encode(array("message" => "No category"));
}
?>