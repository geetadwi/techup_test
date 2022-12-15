$(document).ready(function(){
	$("#addtaskbtn").click(function(e){
		if($("#add-task-form")[0].checkValidity()){
			e.preventDefault();
			
			$.ajax({
				url: 'php/addtask.php',
				method: 'post',
				data: $("#add-task-form").serialize()+'&action=addtask',
				success: function(response){
					$("#addtaskAlert").html(response);
					$("#add-task-form")[0].reset();
						
				}
			});
		}
	});
});