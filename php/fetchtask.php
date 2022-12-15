<?php
require "inc.php";
$output='';
// Fetch Record
$data = $DB->fetchAll(
  "SELECT * FROM `task` order by priority desc"
);
foreach ($data as $row) { 

$output .= '<tr><td>'.$row['subject'].'</td>
									<td><strong>Start Date: </strong> '.date('d F, Y', strtotime($row['start_date'])).' <br><strong>Due Date: </strong> '.date('d F, Y', strtotime($row['due_date'])).'</td>
									<td>'.$row['status'].'</td>
									<td>'.$row['priority'].'</td>
									<td><a href="view-notes.php?id='.$row['task_id'].'"  title="view" class="text-danger userDeleteIcon">ADD Notes</a>&nbsp;&nbsp;&nbsp;<a href="#" id="'.$row['task_id'].'" onclick="ConfirmTaskDelete('.$row['task_id'].')"  title="Delete" class="text-danger">| Delete</a></td>
								</tr>';
			

 }

echo $output;	
