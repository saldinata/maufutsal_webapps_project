var id_competition = "";
var determine_head = 0;

$(document).ready(function() 
{
	$("#searchComp").click(searchComp);
	getAllCompetition();
});


$(document).on("click", "button[id^=joincomp]", getIdComp);
$(document).on("click","button[id^=godashcompinfo]",goCompDashboard);


function goCompDashboard()
{
	document.location.href="dashcompinfo";
}

function getIdComp()
{
	var numbering = parseInt(this.id.replace("joincomp", ""), 10);
	id_competition = $("#compid"+numbering).val();
	
	console.log("id competition = "+id_competition);

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
		        			$('#modalTeam').modal('show');
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


function searchComp()
{
	var compvalue = document.getElementById('autocompletecomp').value;
	var comp_id = [];
	var city_id = [];
	var state = 0;

	if(compvalue=="")
	{
		getAllCompetition();
	}
	else
	{
		var contents = "";

		$.ajax
		({
			type 	: "POST",
			url 	: "api_mf/development.php",
			data 	: "type=reqcomplistname"+"&key="+compvalue,
			dataType: "JSON",
			cache 	: false,
			success	: function(JSONObject)
			{
				var count = 0;

				for(var key in JSONObject)
				{
					if (JSONObject.hasOwnProperty(key)) 
			        {
			        	if((JSONObject[key]["type"])=="rescomplistname")
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
			        	}
			        }
				}

				if(state==0)
				{
					var contents = "";
					var joined = "no";
					var count = 0;
					var head_contents = "";
					determine_head = 0;

					console.log("competition data="+comp_id);

					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowcomplistidcomp"+"&comp_id="+comp_id,
						dataType: "JSON",
						cache 	: false,
						success	: function(JSONObject)
						{
							for (var key in JSONObject)
							{
								count++;

								if(JSONObject.hasOwnProperty(key))
								{
									if((JSONObject[key]["type"])=="resshowcomplistidcomp")
									{
										if((JSONObject[key]["id_competition"])!="-")
										{
											var date_start 		= JSONObject[key]["start_date"];
							        		var date_end 		= JSONObject[key]["end_date"];
							        		var cost			= JSONObject[key]["cost"];
							        		var competition_name= JSONObject[key]["competition_name"];
							        		var id_competition	= JSONObject[key]["id_competition"];
							        		var city_name		= JSONObject[key]["city_name"];
							        		var kind_comp		= JSONObject[key]["kind_comp"];

							        		$.ajax
											({
												type	: "POST",
												url		: "api_mf/development.php",
												data 	: "type=reqchecompartn"+"&id_competition="+id_competition,
												dataType: "JSON",
												cache 	: false,
												async	: false,
												success	: function(JSONObject)
												{
													for(var key in JSONObject)
													{
														if(JSONObject.hasOwnProperty(key))
														{
															if((JSONObject[key]["type"])==="reschecompartn")
															{
																if((JSONObject[key]["joined"])=="yes")
																{
																	joined = "yes";
																	console.log("state joined in ajax = "+joined);
																}
																else
																{
																	joined = "no";
																}
															}
														}
													}
												}
											});


							        		if(determine_head==0)
							        		{
							        			head_contents 	+= "<div class='row'>";
								        		head_contents 	+= "<div class='col-md-12'>";
								        		head_contents 	+= "<h2 class='mb-none'>Daftar Kompetisi</h2>";
												head_contents 	+= "</div>";
												head_contents 	+= "</div>";
												head_contents 	+= "<br>";
												determine_head 	= 1;
							        		}

							        		if(joined=="no")
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
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
								        		contents   += "<h5>Tarif Kompetisi</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Jenis Kompetisi</h5>";
								        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"joincomp"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"compid"+count+"\" />";	
								        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>"; 
							        		}
							        		else
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
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
								        		contents   += "<h5>Tarif Kompetisi</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Jenis Kompetisi</h5>";
								        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"godashcompinfo"+"\" class=\"btn btn-lg btn-success\">Telah Gabung</button>";
								        		contents   += "</p>";
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>";
							        		}
										}
										else
										{
											if(determine_head==0)
							        		{
							        			head_contents 	+= "<div class='row'>";

							        			head_contents 	+= "<div class='col-md-2'>";
							        			head_contents 	+= "&nbsp;";
							        			head_contents 	+= "</div>";

								        		head_contents 	+= "<div class='col-md-8'>";
								        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
												head_contents 	+= "</div>";

												head_contents 	+= "<div class='col-md-2'>";
							        			head_contents 	+= "&nbsp;";
							        			head_contents 	+= "</div>";

												head_contents 	+= "</div>";
												determine_head 	= 1;
							        		}
										}
									}
								}
							}

							$("#competition_contents").html(head_contents+contents);
						}
					});
					return false;
				}
				else if(state==1)
				{
					var contents = "";
					var count = 0;
					var head_contents = "";
					determine_head = 0;

					console.log("city data="+city_id);

					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowcomplistidcity"+"&city_id="+city_id,
						dataType: "JSON",
						cache 	: false,
						success	: function(JSONObject)
						{
							for (var key in JSONObject)
							{
								count++;

								if(JSONObject.hasOwnProperty(key))
								{
									if((JSONObject[key]["type"])=="resshowcomplistidcity")
									{
										if((JSONObject[key]["id_competition"])!="-")
										{
											var date_start 		= JSONObject[key]["start_date"];
							        		var date_end 		= JSONObject[key]["end_date"];
							        		var cost			= JSONObject[key]["cost"];
							        		var competition_name= JSONObject[key]["competition_name"];
							        		var id_competition	= JSONObject[key]["id_competition"];
							        		var city_name		= JSONObject[key]["city_name"];
							        		var kind_comp		= JSONObject[key]["kind_comp"];

							        		$.ajax
											({
												type	: "POST",
												url		: "api_mf/development.php",
												data 	: "type=reqchecompartn"+"&id_competition="+id_competition,
												dataType: "JSON",
												cache 	: false,
												async	: false,
												success	: function(JSONObject)
												{
													for(var key in JSONObject)
													{
														if(JSONObject.hasOwnProperty(key))
														{
															if((JSONObject[key]["type"])==="reschecompartn")
															{
																if((JSONObject[key]["joined"])=="yes")
																{
																	joined = "yes";
																	console.log("state joined in ajax = "+joined);
																}
																else
																{
																	joined = "no";
																}
															}
														}
													}
												}
											});

							        		if(determine_head==0)
							        		{
							        			head_contents 	+= "<div class='row'>";
								        		head_contents 	+= "<div class='col-md-12'>";
								        		head_contents 	+= "<h2 class='mb-none'>Daftar Kompetisi</h2>";
												head_contents 	+= "</div>";
												head_contents 	+= "</div>";
												head_contents 	+= "<br>";
												determine_head 	= 1;
							        		}

							        		if(joined=="no")
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
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
								        		contents   += "<h5>Tarif Kompetisi</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Jenis Kompetisi</h5>";
								        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"joincomp"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"compid"+count+"\" />";	
								        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>"; 
							        		}
							        		else
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
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
								        		contents   += "<h5>Tarif Kompetisi</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Jenis Kompetisi</h5>";
								        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"godashcompinfo"+"\" class=\"btn btn-lg btn-success\">Telah Gabung</button>";
								        		contents   += "</p>";
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>";
							        		}
										}
										else
										{
											if(determine_head==0)
							        		{
							        			head_contents 	+= "<div class='row'>";

							        			head_contents 	+= "<div class='col-md-2'>";
							        			head_contents 	+= "&nbsp;";
							        			head_contents 	+= "</div>";

								        		head_contents 	+= "<div class='col-md-8'>";
								        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
												head_contents 	+= "</div>";

												head_contents 	+= "<div class='col-md-2'>";
							        			head_contents 	+= "&nbsp;";
							        			head_contents 	+= "</div>";

												head_contents 	+= "</div>";
												determine_head 	= 1;
							        		}
										}
									}
								}
							}

							$("#competition_contents").html(head_contents+contents);
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


function getAllCompetition()
{
	var contents = "";
	var count = 0;
	var head_contents = "";
	var available_comp = "0";

	$.ajax
	({
		type	: "POST",
		url		: "api_mf/development.php",
		data 	: "type=reqallcomplist",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for (var key in JSONObject) 
			{
				count++;

		        if (JSONObject.hasOwnProperty(key)) 
		        {
		        	if((JSONObject[key]["type"])=="resallcomplist")
		        	{
		        		if((JSONObject[key]["id_competition"])=="-")
		        		{
		        			if(determine_head==0)
			        		{
			        			head_contents 	+= "<div class='row'>";

			        			head_contents 	+= "<div class='col-md-2'>";
			        			head_contents 	+= "&nbsp;";
			        			head_contents 	+= "</div>";

				        		head_contents 	+= "<div class='col-md-8'>";
				        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
								head_contents 	+= "</div>";

								head_contents 	+= "<div class='col-md-2'>";
			        			head_contents 	+= "&nbsp;";
			        			head_contents 	+= "</div>";

								head_contents 	+= "</div>";
								determine_head 	= 1;
			        		}
		        		}
		        		else
		        		{
		        			var id_competition	= JSONObject[key]["id_competition"];
		        			var date_start 		= JSONObject[key]["date_start"];
			        		var date_end 		= JSONObject[key]["date_end"];
			        		var cost			= JSONObject[key]["cost"];
			        		var competition_name= JSONObject[key]["competition_name"];
			        		var city_name		= JSONObject[key]["city_name"];
			        		var kind_comp		= JSONObject[key]["kind_comp"];
			        		available_comp 		= "1";
			        		var joined 	= "no";

		        			$.ajax
							({
								type	: "POST",
								url		: "api_mf/development.php",
								data 	: "type=reqchecompartn"+"&id_competition="+id_competition,
								dataType: "JSON",
								cache 	: false,
								async	: false,
								success	: function(JSONObject)
								{
									for(var key in JSONObject)
									{
										if(JSONObject.hasOwnProperty(key))
										{
											if((JSONObject[key]["type"])==="reschecompartn")
											{
												if((JSONObject[key]["joined"])=="yes")
												{
													joined = "yes";
													console.log("state joined in ajax = "+joined);
												}
												else
												{
													joined = "no";
												}
											}
										}
									}
								}
							});

			        		if(determine_head==0)
			        		{
			        			head_contents 	+= "<div class='row'>";
				        		head_contents 	+= "<div class='col-md-12'>";
				        		head_contents 	+= "<h2 class='mb-none'>Daftar Kompetisi</h2>";
								head_contents 	+= "</div>";
								head_contents 	+= "</div>";
								head_contents 	+= "<br>";
								determine_head 	= 1;
			        		}

			        		if(joined=="no")
			        		{
			        			contents   += "<div class=\"col-md-12\">";
				        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
				        		contents   += "<div class=\"row\">";

				        		contents   += "<div class=\"col-md-4\">";
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
				        		contents   += "<h5>Tarif Kompetisi</h5>";
				        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
				        		contents   += "</div>";
				        		contents   += "</div>";

				        		contents   += "<div class=\"col-md-3\">";
				        		contents   += "<div class=\"call-to-action-content\">";
				        		contents   += "<h5>Jenis Kompetisi</h5>";
				        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
				        		contents   += "</div>";
				        		contents   += "</div>";

				        		contents   += "<div class=\"col-md-2\">";
				        		contents   += "<div class=\"call-to-action-content\">";
				        		contents   += "<p>";
				        		contents   += "<button id=\"joincomp"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
				        		contents   += "</p>";
				        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"compid"+count+"\" />";	
				        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
				        		contents   += "</div>"; 
				        		contents   += "</div>"; 
				        		contents   += "<br>"; 
				        		contents   += "</section>";  
				        		contents   += "</div>"; 
			        		}
			        		else
			        		{
			        			contents   += "<div class=\"col-md-12\">";
				        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
				        		contents   += "<div class=\"row\">";

				        		contents   += "<div class=\"col-md-4\">";
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
				        		contents   += "<h5>Tarif Kompetisi</h5>";
				        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
				        		contents   += "</div>";
				        		contents   += "</div>";

				        		contents   += "<div class=\"col-md-3\">";
				        		contents   += "<div class=\"call-to-action-content\">";
				        		contents   += "<h5>Jenis Kompetisi</h5>";
				        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
				        		contents   += "</div>";
				        		contents   += "</div>";

				        		contents   += "<div class=\"col-md-2\">";
				        		contents   += "<div class=\"call-to-action-content\">";
				        		contents   += "<p>";
				        		contents   += "<button id=\"godashcompinfo"+"\" class=\"btn btn-lg btn-success\">Telah Gabung</button>";
				        		contents   += "</p>";
				        		contents   += "</div>"; 
				        		contents   += "</div>"; 
				        		contents   += "<br>"; 
				        		contents   += "</section>";  
				        		contents   += "</div>";
			        		}
		        		}
		        	}
		      		else
		      		{
		      		}
		        }
		    }

		    if(available_comp=="0")
    		{
    			contents = "";
				if(determine_head==0)
    			{
    			
    				head_contents 	+= "<div class='row'>";

        			head_contents 	+= "<div class='col-md-2'>";
        			head_contents 	+= "&nbsp;";
        			head_contents 	+= "</div>";

	        		head_contents 	+= "<div class='col-md-8'>";
	        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
					head_contents 	+= "</div>";

					head_contents 	+= "<div class='col-md-2'>";
        			head_contents 	+= "&nbsp;";
        			head_contents 	+= "</div>";

					head_contents 	+= "</div>";
					determine_head 	= 1;
    			}	
    		}

		    $("#competition_contents").html(head_contents+contents);
		}
	});
	return false;
}


document.onkeydown=function(evt)
{
	var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;

	if(keyCode == 13)
	{
		var compvalue = document.getElementById('autocompletecomp').value;
		var comp_id = [];
		var city_id = [];
		var state = 0;
		determine_head = 0;

		if(compvalue=="")
		{
			getAllCompetition();
		}
		else
		{
			var contents = "";

			$.ajax
			({
				type 	: "POST",
				url 	: "api_mf/development.php",
				data 	: "type=reqcomplistname"+"&key="+compvalue,
				dataType: "JSON",
				cache 	: false,
				success	: function(JSONObject)
				{
					var count = 0;

					for(var key in JSONObject)
					{
						if (JSONObject.hasOwnProperty(key)) 
				        {
				        	if((JSONObject[key]["type"])=="rescomplistname")
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
						var contents 	= "";
						var count 		= 0;
						var joined 		= "no";
						var head_contents = "";
						
						console.log("daftar competition"+comp_id);

						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowcomplistidcomp"+"&comp_id="+comp_id,
							dataType: "JSON",
							cache 	: false,
							success	: function(JSONObject)
							{
								for (var key in JSONObject)
								{
									count++;

									if(JSONObject.hasOwnProperty(key))
									{
										if((JSONObject[key]["type"])=="resshowcomplistidcomp")
										{
											if((JSONObject[key]["id_competition"])!="-")
											{
												var date_start 		= JSONObject[key]["start_date"];
								        		var date_end 		= JSONObject[key]["end_date"];
								        		var cost			= JSONObject[key]["cost"];
								        		var competition_name= JSONObject[key]["competition_name"];
								        		var id_competition	= JSONObject[key]["id_competition"];
								        		var city_name		= JSONObject[key]["city_name"];
								        		var kind_comp		= JSONObject[key]["kind_comp"];

								        		$.ajax
												({
													type	: "POST",
													url		: "api_mf/development.php",
													data 	: "type=reqchecompartn"+"&id_competition="+id_competition,
													dataType: "JSON",
													cache 	: false,
													async	: false,
													success	: function(JSONObject)
													{
														for(var key in JSONObject)
														{
															if(JSONObject.hasOwnProperty(key))
															{
																if((JSONObject[key]["type"])==="reschecompartn")
																{
																	if((JSONObject[key]["joined"])=="yes")
																	{
																		joined = "yes";
																		console.log("state joined in ajax = "+joined);
																	}
																	else
																	{
																		joined = "no";
																	}
																}
															}
														}
													}
												});


								        		if(determine_head==0)
								        		{
								        			head_contents 	+= "<div class='row'>";
									        		head_contents 	+= "<div class='col-md-12'>";
									        		head_contents 	+= "<h2 class='mb-none'>Daftar Kompetisi</h2>";
													head_contents 	+= "</div>";
													head_contents 	+= "</div>";
													head_contents 	+= "<br>";
													determine_head 	= 1;
								        		}

								        		if(joined=="no")
								        		{
								        			contents   += "<div class=\"col-md-12\">";
									        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
									        		contents   += "<div class=\"row\">";

									        		contents   += "<div class=\"col-md-4\">";
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
									        		contents   += "<h5>Tarif Kompetisi</h5>";
									        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-3\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<h5>Jenis Kompetisi</h5>";
									        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-2\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<p>";
									        		contents   += "<button id=\"joincomp"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
									        		contents   += "</p>";
									        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"compid"+count+"\" />";	
									        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
									        		contents   += "</div>"; 
									        		contents   += "</div>"; 
									        		contents   += "<br>"; 
									        		contents   += "</section>";  
									        		contents   += "</div>"; 
								        		}
								        		else
								        		{
								        			contents   += "<div class=\"col-md-12\">";
									        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
									        		contents   += "<div class=\"row\">";

									        		contents   += "<div class=\"col-md-4\">";
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
									        		contents   += "<h5>Tarif Kompetisi</h5>";
									        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-3\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<h5>Jenis Kompetisi</h5>";
									        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-2\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<p>";
									        		contents   += "<button id=\"godashcompinfo"+"\" class=\"btn btn-lg btn-success\">Telah Gabung</button>";
									        		contents   += "</p>";
									        		contents   += "</div>"; 
									        		contents   += "</div>"; 
									        		contents   += "<br>"; 
									        		contents   += "</section>";  
									        		contents   += "</div>";
								        		}
											}
											else
											{
												if(determine_head==0)
								        		{
								        			head_contents 	+= "<div class='row'>";

								        			head_contents 	+= "<div class='col-md-2'>";
								        			head_contents 	+= "&nbsp;";
								        			head_contents 	+= "</div>";

									        		head_contents 	+= "<div class='col-md-8'>";
									        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
													head_contents 	+= "</div>";

													head_contents 	+= "<div class='col-md-2'>";
								        			head_contents 	+= "&nbsp;";
								        			head_contents 	+= "</div>";

													head_contents 	+= "</div>";
													determine_head 	= 1;
								        		}
											}
										}
									}
								}

								$("#competition_contents").html(head_contents+contents);
							}
						});
						return false;
					}
					else if(state==1)
					{
						var contents 		= "";
						var head_contents 	= "";
						var count 			= 0;
						var available_comp 	= "0";
						var joined 			= "no";

						console.log("daftar city :"+city_id);

						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowcomplistidcity"+"&city_id="+city_id,
							dataType: "JSON",
							cache 	: false,
							success	: function(JSONObject)
							{
								for (var key in JSONObject)
								{
									count++;

									if(JSONObject.hasOwnProperty(key))
									{
										if((JSONObject[key]["type"])=="resshowcomplistidcity")
										{
											if((JSONObject[key]["id_competition"])!="-")
											{
												var date_start 		= JSONObject[key]["start_date"];
								        		var date_end 		= JSONObject[key]["end_date"];
								        		var cost			= JSONObject[key]["cost"];
								        		var competition_name= JSONObject[key]["competition_name"];
								        		var id_competition	= JSONObject[key]["id_competition"];
								        		var city_name		= JSONObject[key]["city_name"];
								        		var kind_comp		= JSONObject[key]["kind_comp"];
												available_comp = "1";

							        			$.ajax
												({
													type	: "POST",
													url		: "api_mf/development.php",
													data 	: "type=reqchecompartn"+"&id_competition="+id_competition,
													dataType: "JSON",
													cache 	: false,
													async	: false,
													success	: function(JSONObject)
													{
														for(var key in JSONObject)
														{
															if(JSONObject.hasOwnProperty(key))
															{
																if((JSONObject[key]["type"])==="reschecompartn")
																{
																	if((JSONObject[key]["joined"])=="yes")
																	{
																		joined = "yes";
																		console.log("state joined in ajax = "+joined);
																	}
																	else
																	{
																		joined = "no";
																	}
																}
															}
														}
													}
												});

												

								        		if(determine_head==0)
								        		{
								        			head_contents 	+= "<div class='row'>";
									        		head_contents 	+= "<div class='col-md-12'>";
									        		head_contents 	+= "<h2 class='mb-none'>Daftar Kompetisi</h2>";
													head_contents 	+= "</div>";
													head_contents 	+= "</div>";
													head_contents 	+= "<br>";
													determine_head 	= 1;
								        		}

								        		if(joined=="no")
								        		{
								        			contents   += "<div class=\"col-md-12\">";
									        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
									        		contents   += "<div class=\"row\">";

									        		contents   += "<div class=\"col-md-4\">";
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
									        		contents   += "<h5>Tarif Kompetisi</h5>";
									        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-3\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<h5>Jenis Kompetisi</h5>";
									        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-2\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<p>";
									        		contents   += "<button id=\"joincomp"+count+"\" class=\"btn btn-lg btn-warning\">Mulai Gabung</button>";
									        		contents   += "</p>";
									        		contents   += "<input type=\"hidden\" value="+id_competition+" autocomplete=\"off\" readonly id=\"compid"+count+"\" />";	
									        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
									        		contents   += "</div>"; 
									        		contents   += "</div>"; 
									        		contents   += "<br>"; 
									        		contents   += "</section>";  
									        		contents   += "</div>"; 
								        		}
								        		else
								        		{
								        			contents   += "<div class=\"col-md-12\">";
									        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
									        		contents   += "<div class=\"row\">";

									        		contents   += "<div class=\"col-md-4\">";
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
									        		contents   += "<h5>Tarif Kompetisi</h5>";
									        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+cost+",-"+" / tim</span></h4>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-3\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<h5>Jenis Kompetisi</h5>";
									        		contents   += "<h5> Kompetisi "+kind_comp+"</h5>";
									        		contents   += "</div>";
									        		contents   += "</div>";

									        		contents   += "<div class=\"col-md-2\">";
									        		contents   += "<div class=\"call-to-action-content\">";
									        		contents   += "<p>";
									        		contents   += "<button id=\"godashcompinfo"+"\" class=\"btn btn-lg btn-success\">Telah Gabung</button>";
									        		contents   += "</p>";
									        		contents   += "</div>"; 
									        		contents   += "</div>"; 
									        		contents   += "<br>"; 
									        		contents   += "</section>";  
									        		contents   += "</div>";
								        		}
											}
										}
									}
								}

								if(available_comp=="0")
				        		{
				        			contents = "";
									if(determine_head==0)
				        			{
				        			
				        				head_contents 	+= "<div class='row'>";

					        			head_contents 	+= "<div class='col-md-2'>";
					        			head_contents 	+= "&nbsp;";
					        			head_contents 	+= "</div>";

						        		head_contents 	+= "<div class='col-md-8'>";
						        		head_contents 	+= "<h2 class='text-center'> Saat ini belum terdapat kompetisi terbaru</h2>";
										head_contents 	+= "</div>";

										head_contents 	+= "<div class='col-md-2'>";
					        			head_contents 	+= "&nbsp;";
					        			head_contents 	+= "</div>";

										head_contents 	+= "</div>";
										determine_head 	= 1;
				        			}	
				        		}

								$("#competition_contents").html(head_contents+contents);
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
	}//end of if keyCode
}