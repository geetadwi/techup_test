$(document).ready(function(){
	
	fetchAllTask();

	//fetch all users
	function fetchAllTask(){
		$.ajax({
			url: 'php/fetchtask.php',
			method: 'post',
			data: { action: 'fetchAllTask' },
			success: function(response){
				$("#showAllTask").html(response);
				
			}
		});
	}
	
	
	

});