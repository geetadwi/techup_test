$(document).ready(function(){
	
	
	fetchAllNotes();

	//fetch all task
	function fetchAllNotes(){
		var id=document.getElementById('id').value;
		alert('id');
		$.ajax({
			url: 'php/fetchnotes.php',
			method: 'post',
			data: { action: 'id' },
			success: function(response){
				$("#showAllNotes").html(response);
				
			}
		});
	}
	
	
	
	

});