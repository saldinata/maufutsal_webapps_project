$(document).ready(function() 
{
	$("#submit_court_ref").click(saveCourtRef);
});

function saveCourtRef()
{
	var court_name 		= document.getElementById('court_name').value;
	var court_address 	= document.getElementById('court_address').value;
	var court_number 	= document.getElementById('court_number').value;
	var court_mail 		= document.getElementById('court_mail').value;
	var court_owner 	= document.getElementById('court_owner').value;
	var spons_name 		= document.getElementById('spons_name').value;
	var spons_number 	= document.getElementById('spons_number').value;
	var spons_mail 		= document.getElementById('spons_mail').value;

	if(court_name=="" || court_address=="" || court_number=="" || court_mail=="" || court_owner=="" || spons_name=="" || spons_number=="" || spons_mail=="")
	{
		swal("Opps", "Mohon isi field yang masih kosong. Untuk field yang datanya masih belum diketahui, cukup berikan tanda strip (-)", "warning");
	}
	else
	{
		$.ajax
		({
			type 	: "POST",
			url 	: "api_mf/development.php",
			data 	: "type=reqsavecourtref"+"&court_name="+court_name+"&court_address="+court_address+"&court_number="+court_number+"&court_mail="+court_mail+"&court_owner="+court_owner+"&spons_name="+spons_name+"&spons_number="+spons_number+"&spons_mail="+spons_mail,
			dataType: "JSON",
			cache 	: false,
			success : function(JSONObject)
			{
				for (var key in JSONObject)
				{
					if(JSONObject.hasOwnProperty(key))
					{
						if((JSONObject[key]["type"])==="ressavecourtref")
						{
							if((JSONObject[key]["success"])=="true")
							{
								swal("Berhasil","Data Referensi Anda berhasil disubmit. Kami akan menghubungi Anda","success");
								document.getElementById('court_name').value="";
								document.getElementById('court_address').value="";
								document.getElementById('court_number').value="";
								document.getElementById('court_mail').value="";
								document.getElementById('court_owner').value="";
								document.getElementById('spons_name').value="";
								document.getElementById('spons_number').value="";
								document.getElementById('spons_mail').value="";

							}
						}
					}
				}
			}
		});
		return false;
	}

	
}