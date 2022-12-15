<?php
include('php/inc.php');

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <style>
      
        .has-error label,
        .has-error input,
        .has-error textarea {
            color: red;
            border-color: red;
        }
       .list-unstyled li {
            font-size: 13px;
            padding: 4px 0 0;
            color: red;
        }
    </style>
	  <script>
document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script>
</head>

<body oncontextmenu="return false;">
 
    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Task</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                          
                            <li class="active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                   

                    

                                            <div class="col-lg-12">
                                                <div class="card">
                                                <div class="card-header">
                              <p style="float:right"><a href="index.php" class="btn btn-primary btn-sm">Task</a><p>
                            </div>
                                                   <div class="card-body card-block">
												    <div id="addtaskAlert"></div>
												   <form action="" method="post" enctype="multipart/form-data" id="add-task-form" role="form" data-toggle="validator">
									 <div class="form-group">
              <label class="control-label">Subject</label>
              <input type="text" id="inputNames"  minlength="1"  data-error="Please Provide valid Subject." class="form-control" ng-model="model.subject" name="subject" required>
 <div class="help-block with-errors"></div>           
		   </div>
           <div class="form-group">
              <label class="control-label">Description</label>
              <textarea  name="description" minlength="1" class="form-control" style="height:250px;" required></textarea>
 <div class="help-block with-errors"></div>           
		   </div>
												    
           <div class="form-group">
              <label class="control-label">Start Date</label>
              <input type="date" id="inputNames"   data-error="Please Provide Start Date." class="form-control" ng-model="model.subject" name="start_date" required>
 <div class="help-block with-errors"></div>           
		   </div>
           <div class="form-group">
              <label class="control-label">Due Date</label>
              <input type="date" id="inputNames"    data-error="Please Provide Due Date." class="form-control" ng-model="model.subject" name="due_date" required>
 <div class="help-block with-errors"></div>           
		   </div>
           <div class="form-group">
              <label class="control-label">Status</label>
              <select class="form-control" ng-model="model.subject" name="status" required>
                <option value="New">New</option>
                <option value="Incomplete">Incomplete</option>
                <option value="Complete">Complete</option>
</select>
 <div class="help-block with-errors"></div>           
		   </div>
           <div class="form-group">
              <label class="control-label">Priority</label>
              <select class="form-control" ng-model="model.subject" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
</select>
 <div class="help-block with-errors"></div>           
		   </div>
       
                     
    
								<div class="form-group">
								 <button type="submit" id="addtaskbtn" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> Submit
                                                        </button></div>
								</form>                                                   
												   </div>
                                                   
                                                </div>
                                                
                                            </div>

                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                               

                            <script src="vendors/jquery/dist/jquery.min.js"></script>
                            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="assets/js/main.js"></script>
							<script src="assets/js/jquery-3.2.1.min.js"></script>
<script  src="php/js/addtask.js"></script>
<script>CKEDITOR.replace( 'editor1' ); </script>
</body>
</html>
