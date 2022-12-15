<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('../../php/inc.php');
include('../../AuthMiddleware.php');

$allHeaders = getallheaders();

$auth = new Auth($DB, $allHeaders);
$gettoken = new JwtHandler;

if (array_key_exists('Authorization', $allHeaders) && preg_match('/Bearer\s(\S+)/', $allHeaders['Authorization'], $matches)) {

  $datatoken = $gettoken->jwtDecodeData($matches[1]);

  if (isset($datatoken['data']->user_id)) {
  

// get posted data
$data = json_decode(file_get_contents("php://input"));

 
// make sure data is not empty
if(
    
     !empty($_REQUEST['priority']) &&
      !empty($_REQUEST['status']) &&
       !empty($_REQUEST['subject']) &&
       !empty($_REQUEST['description']) &&
       !empty($_REQUEST['start_date']) &&
       !empty($_REQUEST['due_date']) 
){
  
$ins=$DB->exec(
  "INSERT INTO `task` (`subject`, `description`, `status`,`priority`, `start_date`, `due_date`) VALUES (?,?,?,?,?,?)",
  [$_REQUEST["subject"], $_REQUEST["description"], $_REQUEST["status"],$_REQUEST["priority"], $_REQUEST["start_date"], $_REQUEST["due_date"]]
);

        if($ins){
          $row = $DB->fetchAll(
            "SELECT * FROM `task` order by task_id desc limit 1 "
          );
         
        $taskid=$row[0]['task_id'];
$count=count($_REQUEST['notes_sub']);
for($k=0;$k<$count;$k++){
        $DB->exec(
          "INSERT INTO `notes` (`task_id`,`note`,`subject`) VALUES (?,?,?)",
          [$taskid,$_REQUEST['notes_desc'][$k],$_REQUEST['notes_sub'][$k]]
        );
        $data = $DB->fetchAll(
          "SELECT * FROM `notes` order by note_id desc limit 1"
          );
          $noteid=$data[0]['note_id'];
         $errors= array();
         foreach($_FILES['notes_img']['tmp_name'][$k] as $key => $tmp_name ){
           $file_name = time().'-'.$_FILES['notes_img']['name'][$k][$key];
           
           $file_size =$_FILES['notes_img']['size'][$k][$key];
           $file_tmp =$_FILES['notes_img']['tmp_name'][$k][$key];
           $file_type=$_FILES['notes_img']['type'][$k][$key];	
          
        
        if($_FILES['notes_img']['name'][$k][$key]!=''){
        
        $DB->exec(
          "INSERT INTO `notes_image` (`noteid`,`img`) VALUES (?,?)",
          [$noteid,$file_name]
        );
        $desired_dir = "../../upload/"; //Declaring Path for uploaded images
        
        if(is_dir("$desired_dir/".$file_name)==false){
               move_uploaded_file($file_tmp,"../../upload/".$file_name);
               
             }
        
        }
      }
        
        }

              // set response code - 200 OK
              http_response_code(200);
            echo json_encode(array("status" => true,"message" => "Added Successfully"));
           
    
        }else{
          http_response_code(200);
          echo json_encode(array("status" => false,"message" => "Something went wrong","data"=>[]));
        }


}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("status" => false,"message" => "Unable to Save. Data is incomplete","data"=>[]));
    
}

  }else{
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("status" => false,"message" => "token mismatch","data"=>[]));

} } else {
  http_response_code(200);
 
    // tell the user
    echo json_encode(array("status" => true,"message" => "token not found","data"=>[]));
}
?>