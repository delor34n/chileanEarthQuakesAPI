$(document).ready(function(){
	var serverB_URL = "http://www.sismologia.cl/links/tabla.html"
	$.ajax({
		url: 'serverB.php',
		method: 'POST',
		data: {url: serverB_URL},
		success: function(data){
			var response = $(data);
			$("#dirtInfo").html(response);
			console.log($("#dirtInfo .impar"));
		}
	});
});