$(document).ready(function(){
	$('#search').keypress(function(){
		$.ajax({
			type: 'POST',
			url: '../inc/search.php',
			data:{
				name:$("#search").val(),
			},
			success: function(data){
				$("#aaa").html(data);
			}
		})
	})
})