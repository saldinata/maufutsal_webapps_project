$(document).ready(function() 
{
	$("#go_to_payment_comp").click(saveTeam);
});


function saveTeam()
{
	var team_name = document.getElementById('team_name').value;
	console.log("data id competition dari script_comp_list="+id_competition);
	
	$.ajax
	({
		type 	: "POST",
		url 	: "api_mf/development.php",
		data 	: "type=reqaddrpay"+"&team_name="+team_name+"&id_competition="+id_competition,
		dataType: "JSON",
		cache 	: false,
		success : function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if((JSONObject[key]["type"])==="resaddrpay")
					{
						$link = JSONObject[key]["link"];
						document.location.href = $link;
					}
				}
			}
		}
	});
	return false;
}