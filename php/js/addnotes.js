$(document).ready(function(){
	$("#addtaskbtn").click(function(e){
		
		 var form = $('#add-task-form')[0];
        var formData = new FormData(form);
			e.preventDefault();
		
			$.ajax({
				url: 'php/addnotes.php',
				method: 'post',
				processData: false,
				contentType: false,
				data: formData,
            success: function(response){
				$("#addtaskAlert").html(response);
				$("#add-task-form")[0].reset();
						
				}
			});
		
	});
});