<?php
require_once('database.php');

// Get the posted data.
$postdata = file_get_contents("php://input");
print_r($postdata);

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
  print_r($request);


  // Validate.
  if(trim($request->number) === '' || (float)$request->amount < 0)
  {
    return http_response_code(400);
  }

  // Sanitize.
  $number = mysqli_real_escape_string($con, trim($request->number));
  $amount = mysqli_real_escape_string($con, (int)$request->amount);


  // Create.
//   $sql = "INSERT INTO `policies`(`id`,`number`,`amount`) VALUES (null,'{$number}','{$amount}')";

//   if(mysqli_query($con,$sql))
if(true)
  {
    http_response_code(201);
    $policy = [
      'number' => $number,
      'amount' => $amount,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}