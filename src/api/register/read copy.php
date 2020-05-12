<?php
/**
 * Returns the list of policies.
 */
require_once('../config/cors.php');
require_once('../config/database.php');

// required headers
header("Content-Type: application/json; charset=UTF-8");

$policies = [];
$sql = "SELECT id, number, amount FROM policies";

// if($result = mysqli_query($con,$sql))
if(true)
{
  $i = 0;
//   while($row = mysqli_fetch_assoc($result))
  while($i < 2)
  {
    // $policies[$i]['id']    = $row['id'];
    $policies[$i]['id']    = $i;
    $policies[$i]['number'] = 'number'.$i;
    $policies[$i]['amount'] = 'amount'.$i;
    $i++;
  }


  echo json_encode($policies);
}
else
{
  http_response_code(404);
}

?>