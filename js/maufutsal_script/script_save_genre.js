$(document).ready(function() 
{
	$("#save_cat_temp").click(saveCatTemp);
});


function saveCatTemp()
{
	var cat	= $('input[name="genre_first"]:checked').val();

    $.ajax
    ({
        type    : "POST",
        url     : "api_mf/development.php",
        data    : "type=reqpagerespro"+"&cat="+cat+"&court_reg="+court_reg,
        dataType: "JSON",
        cache   : false,
        success : function(JSONObject)
        {
            for(var key in JSONObject)
            {
                if((JSONObject[key]["type"])=="respagerespro")
                {
                    $('input[name="genre_first"]').removeAttr("checked");
                    $('#modalGenre').modal('hide');
                    var link = JSONObject[key]["link"];
                    document.location.href = link;
                }
            }
        }
    });
    return false;
  
}