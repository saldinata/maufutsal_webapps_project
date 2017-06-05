$(document).on("click", "button[id^=sche]",gotoDashCompInfoSche);
$(document).on("click", "button[id^=scor]",gotoDashCompInfoScor);

function gotoDashCompInfoSche()
{
	var numbering 	= parseInt(this.id.replace("sche", ""), 10);
	var id_comp 	= $("#idcomp"+numbering).val();
	var page 		= "schedulle";

	 $.ajax
	 ({
 		type 	: "POST",
 		url 	: "api_mf/development.php",
 		data 	: "type=reqsaveidcomptemp"+"&id_comp="+id_comp+"&page="+page,
 		dataType: "JSON",
 		cache 	: false,
 		success : function(JSONObject)
 		{
 			for(var key in JSONObject )
 			{
 				if(JSONObject[key]["type"]==="ressaveidcomptemp")
 				{
 					$link = JSONObject[key]["link"];
 					document.location.href = $link;
 				}
 			}
 		}
	 });
	 return false;
}

function gotoDashCompInfoScor()
{
	var numbering 	= parseInt(this.id.replace("scor", ""), 10);
	var id_comp 	= $("#idcomp"+numbering).val();
	var page 		= "scoring";

	 $.ajax
	 ({
 		type 	: "POST",
 		url 	: "api_mf/development.php",
 		data 	: "type=reqsaveidcomptemp"+"&id_comp="+id_comp+"&page="+page,
 		dataType: "JSON",
 		cache 	: false,
 		success : function(JSONObject)
 		{
 			for(var key in JSONObject )
 			{
 				if(JSONObject[key]["type"]==="ressaveidcomptemp")
 				{
 					$link = JSONObject[key]["link"];
 					document.location.href = $link;
 				}
 			}
 		}
	 });
	 return false;
}