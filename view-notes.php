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
   <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
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
                        <h1>List</h1>
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
                                            <div class="card-header">
                              <p style="float:right"><a href="index.php" class="btn btn-primary btn-sm">Back to Task</a><p>
                            </div>
                                            <div class="card-body">
                                                <input type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>">
                                <table  class="table table-striped table-bordered">
                                    <thead id="showtaskdetail">
                                       
                                    </thead>
                                   
                                </table>
                            </div>
                                               <div class="card">
                            <div class="card-header">
                              <p style="float:right"><a href="add-notes.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-primary btn-sm">Add Notes</a><p>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                           
											 <th>Subject</th>
                                            <th>Note</th>
                                            <th>Attachments</th>
                                           
											<th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showAllNotes">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                                
                                            </div>

                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
 <script src="assets/js/jquery-3.2.1.min.js"></script>

<script>
    fetchtaskdetail();
    function fetchtaskdetail(){
		
		var id=document.getElementById('id').value;
	
		$.ajax({
			url: 'php/fetchtaskdetail.php',
			method: 'post',
			data: { action: id },
			success: function(response){
				$("#showtaskdetail").html(response);
				
			}
		});
	}

	fetchAllNotes();

	//fetch all task
	function fetchAllNotes(){
		var id=document.getElementById('id').value;
	
		$.ajax({
			url: 'php/fetchnotes.php',
			method: 'post',
			data: { action: id },
			success: function(response){
				$("#showAllNotes").html(response);
				
			}
		});
	}
	
function ConfirmNoteDelete(id){
		
		$.ajax({
			url: 'php/deletenote.php',
			method: 'post',
			data: { action: id },
			success: function(response){
				$("#showAllNotes").html(response);
					
			}
		});
	}</script>
</body>

</html>
