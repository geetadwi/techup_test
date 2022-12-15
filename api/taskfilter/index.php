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


if(
    
  !empty($_REQUEST['filtertype']) &&
   !empty($_REQUEST['keyword']) 
){

  if($_REQUEST['filtertype']!='note'){
    $filterval='t1.'.$_REQUEST['filtertype'];
  }else{
    $filterval='t2.'.$_REQUEST['filtertype'];
  }
$data = $DB->fetchAll(
    "SELECT t1.*, COUNT(t2.note_id) AS note_count
    FROM task as t1,notes as t2
    where t1.task_id = t2.task_id and ".$filterval." like '%".$_REQUEST['keyword']."%'
    GROUP BY t1.task_id
    ORDER BY t1.priority asc,note_count desc"
  );

// check if more than 0 record found
if(count($data)>0)
{
    $data_arr=array();
    foreach ($data as $row) { 

        $datap = $DB->fetchAll(
            "SELECT * FROM `notes` where task_id='".$row['task_id']."' order by note_id desc"
          );
          $dataarr=array();
          foreach ($datap as $rowp) { 

            $datapimage = $DB->fetchAll(
                "SELECT * FROM `notes_image` where noteid='".$rowp['note_id']."'"
              );
              $dataarrimage=array();
              $imgarry=array();
              foreach ($datapimage as $rowpimage) { 
                if($rowpimage['img']!=''){
                $imgarry = array(
                    "attachment" =>  $baseurl.'/upload/'.$rowpimage['img']
                );
        
            }else{
                $imgarry = array();
            }
                array_push($dataarrimage, $imgarry);
              }

            $notearry = array(
                "note" =>  $rowp['note'],
                "subject" => $rowp['subject'],
                "attachmet" => $imgarry
         
            );
    
            array_push($dataarr, $notearry);
          }
        // create array
          $taskarr = array(
              "task_id" =>  $row['task_id'],
              "subject" => $row['subject'],
              "description" => $row['description'],
              "start_date" => $row['start_date'],
              "due_date" => $row['due_date'],
              "status" => $row['status'],
              "priority" => $row['priority'],
              "notecount" => $row['note_count'],
              "notes" => $dataarr,
       
          );
          array_push($data_arr, $taskarr);
        }
          // set response code - 200 OK
          http_response_code(200);
       
          // make it json format
       
          echo json_encode(array("status" => true,"message" => "Data Found Successfully","data"=>$data_arr));
         
      }else{
            http_response_code(200);
             echo json_encode(array("status" => false,"message" => "No Data Found.","data"=>[]));
      }
    }else{
 
      // set response code - 400 bad request
      http_response_code(400);
   
      // tell the user
      echo json_encode(array("status" => false,"message" => "Data is incomplete.","data"=>[]));
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