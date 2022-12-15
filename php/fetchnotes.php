<?php
require "inc.php";
$output='';
// Fetch Record
$data = $DB->fetchAll(
  "SELECT * FROM `notes` where task_id='".$_REQUEST["action"]."' order by note_id desc"
);
foreach ($data as $row) { 

$output .= '<tr><td>'.$row['subject'].'</td>
									
									<td>'.$row['note'].'</td><td>'; ?>
									<?php $datas = $DB->fetchAll(
  "SELECT * FROM `notes_image` where noteid='".$row["note_id"]."'"
);
foreach ($datas as $rows) {  
										$output .= '<a target="_blank" href="upload/'.$rows['img'].' ">View</a><br>';
									 } 
									$output .= '</td><td><a href="#" id="'.$row['note_id'].'" onclick="ConfirmNoteDelete('.$row['note_id'].')"  title="Delete" class="text-danger">Delete</a></td>
								</tr>';
			

 }

echo $output;	

