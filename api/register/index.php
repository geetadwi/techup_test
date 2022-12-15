<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('../../php/inc.php');

// get posted data
$data = json_decode(file_get_contents("php://input"));

 
// make sure data is not empty
if(
    
     !empty($_REQUEST['email']) &&
      !empty($_REQUEST['password']) &&
       !empty($_REQUEST['fullname']) 
){
  $data = $DB->fetchAll(
    "SELECT * FROM `user` where email='".$_REQUEST["email"]."' "
  );
 

if(count($data)<1)
{
$fname=$_REQUEST['fullname'];
$email=$_REQUEST['email'];
$password=md5($_REQUEST['password']);
$ins=$DB->exec(
  "INSERT INTO `user` (`email`, `password`, `fullname`) VALUES (?,?,?)",
  [$email, $password, $fname]
);

        if($ins){
          $data = $DB->fetchAll(
            "SELECT * FROM `user` where email='".$_REQUEST["email"]."' "
          );
         
          foreach ($data as $row) { 
            // create array

              $product_arr = array(
                  "user_id" =>  $row['user_id'],
                  "fullname" => $row['fullname'],
                  "email" => $row['email']
           
              );
            }
              // set response code - 200 OK
              http_response_code(200);
            echo json_encode(array("status" => true,"message" => "Registered Successfully","data"=>$product_arr));
           
    
        }else{
          http_response_code(200);
          echo json_encode(array("status" => false,"message" => "Something went wrong","data"=>[]));
        }

}else{
      http_response_code(200);
      echo json_encode(array("status" => false,"message" => "Email id already registered","data"=>[]));
}
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("status" => false,"message" => "Unable to Registered. Data is incomplete","data"=>[]));
    
}
?>