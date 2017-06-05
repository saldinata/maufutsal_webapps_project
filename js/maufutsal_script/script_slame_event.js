var id_slam="";

$(document).ready(function() 
{
	$("#searchSlam").click(searchSlam);
	getAllSlameEvent();
});

$(document).on("click", "button[id^=joinslam]", getIdSlam);

function getIdSlam()
{
	var numbering = parseInt(this.id.replace("joinslam", ""), 10);
	id_slam = $("#slamid"+numbering).val()

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
		        			var d = new Date();
						    d.setTime(d.getTime() + (15*60*1000));
						    var expires = "expires="+ d.toUTCString();
						    document.cookie = "maufutsal_slam_dat" + "=" + id_slam + ";" + expires + "; path=/";

		        			$('#modalSlamContent').load('web_contents_extends/modal_slam.php');
		        			$('#modalSlam').modal('show');
		        		}
		        		else
		        		{
		        			$('#modalLogin').modal('show');
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



function searchSlam()
{
	var slamvalue = document.getElementById('autocompleteslam').value;
	var comp_id = [];
	var city_id = [];
	var count = 0;
	var state = 0;

	if(slamvalue=="")
	{
		getAllSlameEvent();
	}
	else
	{
		var contents = "";

		$.ajax
		({
			type 	: "POST",
			url 	: "api_mf/development.php",
			data 	: "type=reqslameventlist"+"&key="+slamvalue,
			dataType: "JSON",
			cache 	: false,
			success	: function(JSONObject)
			{
				for(var key in JSONObject)
				{
					if (JSONObject.hasOwnProperty(key)) 
			        {
			        	if((JSONObject[key]["type"])=="resslameventlist")
			        	{
			        		if(JSONObject[key]["id_competition"]=="-")
			        		{
			        			var city_id_value = JSONObject[key]["id_city"];
			        			city_id[count] = city_id_value;
			        			count++;
			        			state=1;
			        		}
			        		else
			        		{
			        			var comp_id_value = JSONObject[key]["id_competition"];
			        			comp_id[count] = comp_id_value;
			        			count++;
			        			state=0;
			        		}
			        	}
			        	else
			        	{
			        		// no from ressearchfield
			        	}
			        }
				}

				if(state==0)
				{
					var contents = "";

					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowslameventlistidcomp"+"&comp_id="+comp_id,
						dataType: "JSON",
						cache 	: false,
						success	: function(JSONObject)
						{
							for (var key in JSONObject)
							{
								if(JSONObject.hasOwnProperty(key))
								{
									if((JSONObject[key]["type"])=="resshowslameventlistidcomp")
									{
										var date_start 		= JSONObject[key]["start_date"];
						        		var date_end 		= JSONObject[key]["end_date"];
						        		var cost			= JSONObject[key]["cost"];
						        		var competition_name= JSONObject[key]["competition_name"];
						        		var id_competition	= JSONObject[key]["id_competition"];
						        		var city_name		= JSONObject[key]["city_name"];
						        		var kind_comp		= JSONObject[key]["kind_comp"];

						        		contents   += "<div class=\"col-md-12\">";
						        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
						        		contents   += "<div class=\"row\">";

						        		contents   += "<div class=\"col-md-5\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<h4>"+competition_name+"</h4>";
						        		contents   += "<h6>";
						        		contents   += "Mulai "+date_start + " hingga " + date_end;
						        		contents   += "</h6>";
						        		contents   += "<h6>"+city_name+"</h6>"
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-3\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<h5>Tarif Ajang Tanding</h5>";
						        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-2\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		// contents   += "<h5>Jenis Kompetisi</h5>";
						        		// contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-2\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<p>";
						        		contents   += "<button id=\"joinslam"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
						        		contents   += "</p>";
						        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"slamid"+count+"\" />";	
						        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
						        		contents   += "</div>"; 
						        		contents   += "</div>"; 
						        		contents   += "<br>"; 
						        		contents   += "</section>";  
						        		contents   += "</div>";  
									}
								}
							}

							$("#slam_contents").html(contents);
						}
					});
					return false;
				}
				else if(state==1)
				{
					var contents = "";

					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowslameventlistidcity"+"&city_id="+city_id,
						dataType: "JSON",
						cache 	: false,
						success	: function(JSONObject)
						{
							for (var key in JSONObject)
							{
								if(JSONObject.hasOwnProperty(key))
								{
									if((JSONObject[key]["type"])=="resshowslameventlistidcity")
									{
										var date_start 		= JSONObject[key]["start_date"];
						        		var date_end 		= JSONObject[key]["end_date"];
						        		var cost			= JSONObject[key]["cost"];
						        		var competition_name= JSONObject[key]["competition_name"];
						        		var id_competition	= JSONObject[key]["id_competition"];
						        		var city_name		= JSONObject[key]["city_name"];
						        		var kind_comp		= JSONObject[key]["kind_comp"];

						        		contents   += "<div class=\"col-md-12\">";
						        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
						        		contents   += "<div class=\"row\">";

						        		contents   += "<div class=\"col-md-5\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<h4>"+competition_name+"</h4>";
						        		contents   += "<h6>";
						        		contents   += "Mulai "+date_start + " hingga " + date_end;
						        		contents   += "</h6>";
						        		contents   += "<h6>"+city_name+"</h6>"
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-3\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<h5>Tarif Ajang Tanding</h5>";
						        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-2\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		// contents   += "<h5>Jenis Kompetisi</h5>";
						        		// contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
						        		contents   += "</div>";
						        		contents   += "</div>";

						        		contents   += "<div class=\"col-md-2\">";
						        		contents   += "<div class=\"call-to-action-content\">";
						        		contents   += "<p>";
						        		contents   += "<button id=\"joinslam"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
						        		contents   += "</p>";
						        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"slamid"+count+"\" />";	
						        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
						        		contents   += "</div>"; 
						        		contents   += "</div>"; 
						        		contents   += "<br>"; 
						        		contents   += "</section>";  
						        		contents   += "</div>";   
									}
								}
							}

							$("#slam_contents").html(contents);
						}
					});
				}
				else
				{

				}
			}
		});
		return false;
	}
}

function getAllSlameEvent()
{
	var contents = "";

	$.ajax
	({
		type	: "POST",
		url		: "api_mf/development.php",
		data 	: "type=reqallslamevent",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			var count = 0;

			for (var key in JSONObject) 
			{
				count++;

		        if (JSONObject.hasOwnProperty(key)) 
		        {
		        	if((JSONObject[key]["type"])=="resallslamevent")
		        	{
		        		if((JSONObject[key]["id_competition"])=="-")
		        		{

		        		}
		        		else
		        		{
		        			var date_start 		= JSONObject[key]["date_start"];
			        		var date_end 		= JSONObject[key]["date_end"];
			        		var cost			= JSONObject[key]["cost"];
			        		var competition_name= JSONObject[key]["competition_name"];
			        		var id_competition	= JSONObject[key]["id_competition"];
			        		var city_name		= JSONObject[key]["city_name"];
			        		var kind_comp		= JSONObject[key]["kind_comp"];

			        		contents   += "<div class=\"col-md-12\">";
			        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
			        		contents   += "<div class=\"row\">";

			        		contents   += "<div class=\"col-md-5\">";
			        		contents   += "<div class=\"call-to-action-content\">";
			        		contents   += "<h4>"+competition_name+"</h4>";
			        		contents   += "<h6>";
			        		contents   += "Mulai "+date_start + " hingga " + date_end;
			        		contents   += "</h6>";
			        		contents   += "<h6>"+city_name+"</h6>"
			        		contents   += "</div>";
			        		contents   += "</div>";

			        		contents   += "<div class=\"col-md-3\">";
			        		contents   += "<div class=\"call-to-action-content\">";
			        		contents   += "<h5>Tarif Ajang Tanding</h5>";
			        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
			        		contents   += "</div>";
			        		contents   += "</div>";

			        		contents   += "<div class=\"col-md-2\">";
			        		contents   += "<div class=\"call-to-action-content\">";
			        		// contents   += "<h5>Jenis Kompetisi</h5>";
			        		// contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
			        		contents   += "</div>";
			        		contents   += "</div>";

			        		contents   += "<div class=\"col-md-2\">";
			        		contents   += "<div class=\"call-to-action-content\">";
			        		contents   += "<p>";
			        		contents   += "<button id=\"joinslam"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
			        		contents   += "</p>";
			        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"slamid"+count+"\" />";	
			        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
			        		contents   += "</div>"; 
			        		contents   += "</div>"; 
			        		contents   += "<br>"; 
			        		contents   += "</section>";  
			        		contents   += "</div>"; 
		        		}
		        	}
		      		else
		      		{
		      		}
		        }
		    }

		    $("#slam_contents").html(contents);
		}
	});
	return false;
}


document.onkeydown=function(evt)
{
	var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;

	if(keyCode == 13)
	{
		var slamvalue = document.getElementById('autocompleteslam').value;
		var comp_id = [];
		var city_id = [];
		var count = 0;
		var state = 0;

		if(slamvalue=="")
		{
			getAllSlameEvent();
		}
		else
		{
			var contents = "";

			$.ajax
			({
				type 	: "POST",
				url 	: "api_mf/development.php",
				data 	: "type=reqslameventlist"+"&key="+slamvalue,
				dataType: "JSON",
				cache 	: false,
				success	: function(JSONObject)
				{
					for(var key in JSONObject)
					{
						if (JSONObject.hasOwnProperty(key)) 
				        {
				        	if((JSONObject[key]["type"])=="resslameventlist")
				        	{
				        		if(JSONObject[key]["id_competition"]=="-")
				        		{
				        			var city_id_value = JSONObject[key]["id_city"];
				        			city_id[count] = city_id_value;
				        			count++;
				        			state=1;
				        		}
				        		else
				        		{
				        			var comp_id_value = JSONObject[key]["id_competition"];
				        			comp_id[count] = comp_id_value;
				        			count++;
				        			state=0;
				        		}
				        	}
				        	else
				        	{
				        		// no from ressearchfield
				        	}
				        }
					}

					if(state==0)
					{
						var contents = "";

						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowslameventlistidcomp"+"&comp_id="+comp_id,
							dataType: "JSON",
							cache 	: false,
							success	: function(JSONObject)
							{
								for (var key in JSONObject)
								{
									if(JSONObject.hasOwnProperty(key))
									{
										if((JSONObject[key]["type"])=="resshowslameventlistidcomp")
										{
											var date_start 		= JSONObject[key]["start_date"];
							        		var date_end 		= JSONObject[key]["end_date"];
							        		var cost			= JSONObject[key]["cost"];
							        		var competition_name= JSONObject[key]["competition_name"];
							        		var id_competition	= JSONObject[key]["id_competition"];
							        		var city_name		= JSONObject[key]["city_name"];
							        		var kind_comp		= JSONObject[key]["kind_comp"];

							        		contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-5\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+competition_name+"</h4>";
							        		contents   += "<h6>";
							        		contents   += "Mulai "+date_start + " hingga " + date_end;
							        		contents   += "</h6>";
							        		contents   += "<h6>"+city_name+"</h6>"
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Ajang Tanding</h5>";
							        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		// contents   += "<h5>Jenis Kompetisi</h5>";
							        		// contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"joinslam"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"slamid"+count+"\" />";	
							        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
							        		contents   += "</div>"; 
							        		contents   += "</div>"; 
							        		contents   += "<br>"; 
							        		contents   += "</section>";  
							        		contents   += "</div>";  
										}
									}
								}

								$("#slam_contents").html(contents);
							}
						});
						return false;
					}
					else if(state==1)
					{
						var contents = "";

						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowslameventlistidcity"+"&city_id="+city_id,
							dataType: "JSON",
							cache 	: false,
							success	: function(JSONObject)
							{
								for (var key in JSONObject)
								{
									if(JSONObject.hasOwnProperty(key))
									{
										if((JSONObject[key]["type"])=="resshowslameventlistidcity")
										{
											var date_start 		= JSONObject[key]["start_date"];
							        		var date_end 		= JSONObject[key]["end_date"];
							        		var cost			= JSONObject[key]["cost"];
							        		var competition_name= JSONObject[key]["competition_name"];
							        		var id_competition	= JSONObject[key]["id_competition"];
							        		var city_name		= JSONObject[key]["city_name"];
							        		var kind_comp		= JSONObject[key]["kind_comp"];

							        		contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-5\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+competition_name+"</h4>";
							        		contents   += "<h6>";
							        		contents   += "Mulai "+date_start + " hingga " + date_end;
							        		contents   += "</h6>";
							        		contents   += "<h6>"+city_name+"</h6>"
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Ajang Tanding</h5>";
							        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		// contents   += "<h5>Jenis Kompetisi</h5>";
							        		// contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"joinslam"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"slamid"+count+"\" />";	
							        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
							        		contents   += "</div>"; 
							        		contents   += "</div>"; 
							        		contents   += "<br>"; 
							        		contents   += "</section>";  
							        		contents   += "</div>";   
										}
									}
								}

								$("#slam_contents").html(contents);
							}
						});
					}
					else
					{

					}
				}
			});
			return false;
		}
	}
	
}