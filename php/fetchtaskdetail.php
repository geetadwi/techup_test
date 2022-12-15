<?php
require "inc.php";
$output='';
// Fetch Record
$data = $DB->fetchAll(
  "SELECT * FROM `task` where task_id='".$_REQUEST["action"]."' order by priority desc"
);
foreach ($data as $row) { 

$output .= '<tr><th>Subject</th><td>'.$row['subject'].'</td></tr>
<tr><th>Date</th><td><strong>Start Date: </strong> '.date('d F, Y', strtotime($row['start_date'])).' <br><strong>Due Date: </strong> '.date('d F, Y', strtotime($row['due_date'])).'</td></tr>
									<tr><th>Status</th><td>'.$row['status'].'</td></tr>
									<tr><th>Priority</th><td>'.$row['priority'].'</td></tr>
									<tr><th>Description</th><td>'.$row['description'].'</td>
											</tr>';
			

 }

echo $output;	
