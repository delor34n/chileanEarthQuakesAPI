$(document).ready(function(){
	var serverB_URL = "http://www.sismologia.cl/links/tabla.html"
	$.ajax({
		url: 'serverB.php',
		method: 'POST',
		data: {url: serverB_URL},
		dataType: 'json',
		success: function(data){
			$("#dirtInfo").html($(data.html));
			$("#cleanInfo").html(JSON.stringify(data.json));
		}
	});
});