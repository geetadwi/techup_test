<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('../../php/inc.php');
include('../../classes/JwtHandler.php');
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    
     !empty($_REQUEST['email']) &&
      !empty($_REQUEST['password']) 
){
 
   
  $data = $DB->fetchAll(
    "SELECT * FROM `user` where email='".$_REQUEST["email"]."' and password='".md5($_REQUEST["password"])."'"
  );
 

if(count($data)>0)
{
  foreach ($data as $row) { 

    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/oro/',
                        array("user_id"=> $row['user_id'])
                    );


  // create array
    $product_arr = array(
        "user_id" =>  $row['user_id'],
        "fullname" => $row['fullname'],
        "email" => $row['email'],
        "token" => $token
 
    );
  }
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
 
    echo json_encode(array("status" => true,"message" => "Login Successfully","data"=>$product_arr));
   
}else{
      http_response_code(200);
       echo json_encode(array("status" => false,"message" => "Email id/password not matched.","data"=>[]));
}
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("status" => false,"message" => "Unable to Login. Data is incomplete.","data"=>[]));
}
?>