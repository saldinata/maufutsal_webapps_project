$(document).ready(function() 
{
    $("#save_cat_fb").click(saveCatFB);
});


function saveCatFB()
{
    var cat_fb  = $('input[name="genre_fb"]:checked').val();
    alert(email_fb_globe);

    $.ajax
    ({
        type    : "POST",
        url     : "api_mf/development.php",
        data    : "type=reqstorecatfb"+"&cat="+cat_fb+"&email="+email_fb_globe,
        dataType: "JSON",
        cache   : false,
        success : function(JSONObject)
        {
            for(var key in JSONObject)
            {
                if((JSONObject[key]["type"])=="resstorecatfb")
                {
                    if((JSONObject[key]["success"])=="true")
                    {
                        $('input[name="genre_fb"]').removeAttr("checked");
                        $('#modalGenreFacebook').modal('hide');
                        location.reload();
                    }
                    else
                    {

                    }
                }
            }
        }
    });
    return false;
}