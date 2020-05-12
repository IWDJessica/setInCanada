<?php
/**
 * Returns the list of policies.
 */
// required headers
// header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('database.php');

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