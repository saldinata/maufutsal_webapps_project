var genre 		= "";
var genreBase	="";
var cost_temp	="";
var state_temp	= "";

$(document).ready(function()
{
	reqcourtinfo();
	reqcourtarena();
	reqreservtime();
	//reqcategory();
	reqtimeusage();
	checklogin();

	//getMemberData();
	//getCatData();

	$('#reserv_date').change(getprice);
	$('#arena_name').change(getprice);
	$('#reserv_time').change(getprice);
	$('#timeusage').change(getprice);
	$('#category').change(getprice);

	$('#continue_payment').click(getpaymentpage);
	$('#see_cost').click(see_cost);


	var date_input=$('input[id="reserv_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker
		({
			format: 'dd-mm-yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})

});


function see_cost()
{
	var cat_data 	= document.getElementById('cat_data').value;
	var court_reg 	= document.getElementById('court_reg').value;

	$("#data").html("");
	$.ajax
	({
		type		: "POST",
		data 		: "type=reqcost"+"&cat_data="+cat_data+"&court_reg="+court_reg,
		url 		: "api_mf/development.php",
		dataType	: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="rescost")
					{
						var nama_arena 	= JSONObject[key]["nama_arena"];
						var price_online	= "Rp."+accounting.formatNumber(JSONObject[key]["price_online"]);
						var valid_hour		= JSONObject[key]["valid_hour"];

						$("#data").append("<tr><td style=\"text-align:center;padding: 7px;\">"+nama_arena+"</td><td style=\"text-align:right;padding: 7px;\">"+price_online+"</td><td style=\"text-align:center;padding: 7px;\">"+valid_hour+"</td></tr>");
					}
				}
			}

			$('#modalCost').modal('show');
		}
	});
	return false;


}


function reqcourtinfo()
{
	var court_reg = document.getElementById('court_reg').value;
	$.ajax
	({
		type 		: "POST",
		url		: "api_mf/development.php",
		data		: "type=reqcourtinfo"+"&court_reg="+court_reg,
		dataType	: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="rescourtinfo")
					{
						$("#court_name").html(JSONObject[key]["field_name"]);
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

function reqcourtarena()
{
	var court_reg = document.getElementById('court_reg').value;
	var contents = "";
	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqcourtarena"+"&court_reg="+court_reg,
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="rescourtarena")
					{
						contents += "<option value="+JSONObject[key]["arena_code"]+">"+JSONObject[key]["arena_name"]+"</option>";
					}
					else
					{

					}
				}
			}

			$("#arena_name").html(contents);
		}
	});
	return false;
}


function reqreservtime()
{
	var contents = "";
	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqreservtime",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="resreservtime")
					{
						contents += "<option value="+JSONObject[key]["time"]+">"+JSONObject[key]["time"]+"</option>";
					}
					else
					{

					}
				}
			}

			$("#reserv_time").html(contents);
		}
	});
	return false;
}


function reqcategory()
{
	var contents = "";
	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqcategory",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="rescategory")
					{
						//genreBase = JSONObject[key]["category_code"];

						// if(genreBase==genre)
						// {
							contents += "<option value="+JSONObject[key]["category_code"]+">"+JSONObject[key]["category_name"]+"</option>";

						// }
						// else
						// {

						// }

					}
					else
					{

					}
				}
			}

			$("#category").html(contents);
		}
	});
	return false;
}


function reqtimeusage()
{
	var contents = "";
	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqtimeusage",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="restimeusage")
					{
						contents += "<option value="+JSONObject[key]["time_usage"]+">"+JSONObject[key]["time_usage"]+" jam"+"</option>";
					}
					else
					{

					}
				}
			}

			$("#timeusage").html(contents);
		}
	});
	return false;
}


function getprice()
{
	var current_date	= document.getElementById('reserv_date').value;
	var court_reg		= document.getElementById('court_reg').value;
	var field_code		= document.getElementById('arena_name').value;
	var code_cat		= document.getElementById('category').value;
	var start_time		= document.getElementById('reserv_time').value;
	var duration_time	= document.getElementById('timeusage').value;

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqreservtrans"+"&current_date="+current_date+"&court_reg="+court_reg+"&field_code="+field_code+"&code_cat="+code_cat+"&start_time="+start_time+"&duration_time="+duration_time,
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="resreservtrans")
					{
						cost_temp	= JSONObject[key]["final_cost"];
						state_temp	= JSONObject[key]["book_state"];

						$('#cost').html("Rp. "+JSONObject[key]["final_cost"] +",-");
						$('#state').html(JSONObject[key]["book_state"]);
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

function checklogin()
{
	$.ajax
	({
		type 	: "POST",
		url 	: "api_mf/development.php",
		data 	: "type=reqcheseslog",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if (JSONObject.hasOwnProperty(key))
		        {
		        	if((JSONObject[key]["type"])==="rescheseslog")
		        	{
		        		if(JSONObject[key]["login_state"]==="true")
		        		{
							getMemberData();
		        		}
		        		else
		        		{
		        			getCatData();
		        		}
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


function getCatData()
{
	var contents = "";
	var check_cookies_data = "";

    check_cookies_data = document.getElementById('cat_data').value;

    if(check_cookies_data==1)
    {
    	contents += "<option value="+check_cookies_data+">Pelajar</option>";
    }
    else if(check_cookies_data==2)
    {
    	contents += "<option value="+check_cookies_data+">Mahasiswa</option>";
    }
    else if(check_cookies_data==3)
    {
    	contents += "<option value="+check_cookies_data+">Pekerja/Umum</option>";
    }
    else
    {

    }

	$("#category").html(contents);
}



function getMemberData()
{
	var contents = "";

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqgetmemberdata",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="resgetmemberdata")
					{
						genre = JSONObject[key]["genre"];
						if(genre==="1")
						{
							contents += "<option value="+genre+">Pelajar</option>";
						}
						else if(genre==="2")
						{
							contents += "<option value="+genre+">Mahasiswa</option>";
						}
						else if(genre==="3")
						{
							contents += "<option value="+genre+">Pekerja/Umum</option>";
						}
						else
						{

						}
					}
					else
					{

					}
				}
			}
			$("#category").html(contents);
		}
	});

	return false;
}


function getpaymentpage()
{
	$.ajax
	({
		type 	: "POST",
		url 	: "api_mf/development.php",
		data 	: "type=reqcheseslog",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if (JSONObject.hasOwnProperty(key))
		        {
		        	if((JSONObject[key]["type"])==="rescheseslog")
		        	{
		        		if(JSONObject[key]["login_state"]==="true")
		        		{
							var current_date 	= document.getElementById('reserv_date').value;
							var court_reg			= document.getElementById('court_reg').value;
							var field_code		= document.getElementById('arena_name').value;
							var code_cat 			= document.getElementById('category').value;
							var start_time		= document.getElementById('reserv_time').value;
							var duration_time	= document.getElementById('timeusage').value;
							var cost 					= cost_temp;
							var state 				= state_temp;

							$.ajax
							({
								type 	: "POST",
								url		: "api_mf/development.php",
								data	: "type=reqpaymentpage"+"&current_date="+current_date+"&court_reg="+court_reg+"&field_code="+field_code+"&code_cat="+code_cat+"&start_time="+start_time+"&duration_time="+duration_time+"&cost="+cost+"&state="+state,
								dataType: "JSON",
								cache 	: false,
								success	: function(JSONObject)
								{
									for(var key in JSONObject)
									{
										if(JSONObject.hasOwnProperty(key))
										{
											if(JSONObject[key]["type"]==="respaymentpage")
											{
												if(JSONObject[key]["warning"]==="true")
												{
													swal("Oops !", "Tarif Rp.0,- atau status unavailable tidak dapat direservasi", "error");
												}
												else if(JSONObject[key]["warning"]==="false")
												{
													var link = JSONObject[key]["link"];
													document.location.href=link;
												}
												else
												{

												}
											}
										}
									}
								}
							});
		        		}
		        		else
		        		{
		        			// show modal login
		        			$('#modalLoginPayment').modal('show');
		        		}
		        	}
		        }
		    }
		}
	});
}
