$(document).ready(function() 
{
	$('#confirm_now').click(gotoConfirmPage);
});

function gotoConfirmPage()
{
    $.ajax
    ({
        type    : "POST",
        url     : "api_mf/development.php",
        data    : "type=reqconfirmpage",
        dataType: "JSON",
        cache   : false,
        success : function(JSONObject)
        {
            for(var key in JSONObject)
            {
                if((JSONObject[key]["type"])=="resconfirmpage")
                {
                    var link = JSONObject[key]["link"];
                    document.location.href = link;
                }
            }
        }
    });
    return false;
}