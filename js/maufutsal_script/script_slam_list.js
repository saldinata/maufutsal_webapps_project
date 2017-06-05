$(document).ready(function() 
{
	$("#go_to_payment_slam").click(saveSlamData);
});

function saveSlamData()
{
	var team_name = document.getElementById('team_name_slam').value;
	var cookies_name = "maufutsal_slam_dat=";
	var allVals = [];
	var id_slam;

	$("#checkboxlist input:checked").each(function() 
	{
		allVals.push($(this).val());
	});

    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0) == ' ') 
        {
            c = c.substring(1);
        }
        if (c.indexOf(cookies_name) == 0) 
        {
            id_slam = c.substring(cookies_name.length, c.length);
        }
    }	

	$.ajax
	({
		type 	: "POST",
		url 	: "api_mf/development.php",
		data 	: "type=reqaddrpayforslam"+"&team_name="+team_name+"&field="+allVals+"&id_slam="+id_slam,
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if((JSONObject[key]["type"])==="resaddrpayforslam")
					{
						$link = JSONObject[key]["link"];
						document.location.href = $link;
					}
				}
			}
		}
	});
	
}