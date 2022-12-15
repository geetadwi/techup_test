<?php
require "inc.php";

echo $DB->exec(
  "INSERT INTO `task` (`subject`, `description`, `status`,`priority`, `start_date`, `due_date`) VALUES (?,?,?,?,?,?)",
  [$_POST["subject"], $_POST["description"], $_POST["status"],$_POST["priority"], $_POST["start_date"], $_POST["due_date"]]
) ? "<div  class='alert alert-success'>Task Successfully!</div>" : $DB->error ;	
