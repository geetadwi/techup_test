<?php
require "inc.php";

$DB->exec(
	"INSERT INTO `notes` (`task_id`,`note`,`subject`) VALUES (?,?,?)",
	[$_POST["task_id"],$_POST["note"],$_POST["subject"]]
);
$data = $DB->fetchAll(
	"SELECT * FROM `notes` order by note_id desc limit 1"
  );
  $noteid=$data[0]['note_id'];
 $errors= array();
 foreach($_FILES['small']['tmp_name'] as $key => $tmp_name ){
	 $file_name = time().'-'.$_FILES['small']['name'][$key];
	 
	 $file_size =$_FILES['small']['size'][$key];
	 $file_tmp =$_FILES['small']['tmp_name'][$key];
	 $file_type=$_FILES['small']['type'][$key];	
	

if($_FILES['small']['name'][$key]!=''){

$DB->exec(
	"INSERT INTO `notes_image` (`noteid`,`img`) VALUES (?,?)",
	[$noteid,$file_name]
);
$desired_dir = "../upload/"; //Declaring Path for uploaded images

if(is_dir("$desired_dir/".$file_name)==false){
			 move_uploaded_file($file_tmp,"../upload/".$file_name);
			 
		 }

}


}

echo '<div  class="alert alert-success">Added Successfully!</div>';