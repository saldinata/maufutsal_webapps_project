var check_cookies_data ="";
var court_reg 		= "";
var head_contents	= "";
var determine_head 	= 0;
var dataFieldCalculation = "";
var lat = 0;
var lng = 0;


$(document).on("click", "button[id^=reserv]", getCourtReg);
$(document).on("click", "button[id^=ref_lapangan]", gotoRefField);
$(document).on("click", "a[id^=maps]", showMaps);


function getCourtReg()
{
	var numbering = parseInt(this.id.replace("reserv", ""), 10);
	court_reg = $("#coreg"+numbering).val();

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
							$.ajax
							({
								type 	: "POST",
								url 	: "api_mf/development.php",
								data 	: "type=reqaddrreservpro"+"&court_reg="+court_reg,
								dataType: "JSON",
								cache 	: false,
								success	: function(JSONObject)
								{
									for (var key in JSONObject) 
									{
										if (JSONObject.hasOwnProperty(key)) 
								        {
								        	if((JSONObject[key]["type"])==="resaddrreservpro")
								        	{
								        		var link_address	= JSONObject[key]["link"];
								        		document.location.href= link_address;
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
		        		else
		        		{
		        			//$('#modalLogin').modal('show');

		        			var name = "maufutsal_cat_dat=";
						    var ca = document.cookie.split(';');
						    for(var i = 0; i <ca.length; i++) 
						    {
						        var c = ca[i];
						        while (c.charAt(0)==' ') 
						        {
						            c = c.substring(1);
						        }
						        if (c.indexOf(name) == 0) 
						        {
						           check_cookies_data = c.substring(name.length,c.length);
						        }
						    }

						    if(check_cookies_data=="")
						    {
						    	$('#modalGenre').modal('show');
						    }
						    else
						    {
						    	$.ajax
								({
									type 	: "POST",
									url 	: "api_mf/development.php",
									data 	: "type=reqaddrreservpro"+"&court_reg="+court_reg,
									dataType: "JSON",
									cache 	: false,
									success	: function(JSONObject)
									{
										for (var key in JSONObject) 
										{
											if (JSONObject.hasOwnProperty(key)) 
									        {
									        	if((JSONObject[key]["type"])==="resaddrreservpro")
									        	{
									        		var link_address	= JSONObject[key]["link"];
									        		document.location.href= link_address;
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


$(document).ready(function() 
{
	$("#searchfield").click(searchField);
	getAllPromotionField();
});


function myMap(coordinate) 
{
	var newCoords = coordinate.split(',');
	console.log("lat data = "+newCoords[0]);
	console.log("lng data = "+newCoords[1]);

	var mapCanvas = document.getElementById("map");
	var center = new google.maps.LatLng(newCoords[0],newCoords[1]);
	
	var mapOptions = {center: center, zoom: 15};
	var map = new google.maps.Map(mapCanvas,mapOptions);
	var marker = new google.maps.Marker
  	({
	  	map: map,
	    position: center,

	    animation: google.maps.Animation.BOUNCE
  	});
  	marker.setMap(map);

	lastCenter=map.getCenter();
	google.maps.event.trigger(map, 'resize');
	map.setCenter(lastCenter);
}


function showMaps()
{
	var numbering = parseInt(this.id.replace("maps",""),10);
	var court_reg_for_maps = $("#coreg"+numbering).val();

	$.ajax
	({
		type 	: "POST",
		url 	: "api_mf/development.php",
		data 	: "type=reqmapcordinate"+"&court_reg="+court_reg_for_maps,
		dataType: "JSON",
		cache 	: false,
		async: false,
		success : function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if((JSONObject[key]["type"])=="resmapcordinate")
					{
						lat = JSONObject[key]["lat"];
						lng = JSONObject[key]["lng"];
					}
				}
			}
		}
	});	

	console.log("lat = "+lat);
	console.log("lng = "+lng);

    $('#modalFieldMaps').modal
	({
        backdrop: 'static',
        keyboard: false,
    }).on('shown.bs.modal', function () 
    	{
      		var coords = String(lat+","+lng);
      		myMap(coords);
    	});	
}


function gotoRefField()
{
	console.log("this button is clicked");
	$.ajax
	({
		type	: "POST",
		url		: "api_mf/development.php",
		data 	: "type=reqcourtref",
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for (var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if((JSONObject[key]["type"])=="rescourtref")
					{
						$link = JSONObject[key]["link"];
						document.location.href = $link;
					}
				}
			}
		}
	});
}


function getAllPromotionField()
{
	var contents 	= "";

	$.ajax
	({
		type	: "POST",
		url		: "api_mf/development.php",
		data 	: "type=reqallpromofieldlist",
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
		        	if((JSONObject[key]["type"])=="resallpromofieldlist")
		        	{
		        		if((JSONObject[key]["promo_state"])=="yes")
		        		{
		        			var date_start 		= JSONObject[key]["date_start"];
			        		var date_end 		= JSONObject[key]["date_end"];
			        		var court_reg		= JSONObject[key]["court_reg"];
			        		var court_name 		= JSONObject[key]["court_name"];
			        		var court_address	= JSONObject[key]["court_address"];
			        		var promo_price 	= JSONObject[key]["promo_price"]; 

			        		if(determine_head==0)
			        		{
			        			head_contents 	+= "<div class='row'>";
				        		head_contents 	+= "<div class='col-md-12'>";
				        		head_contents 	+= "<h2 class='mb-none'>Penawaran Hot Promo Lapangan Futsal</h2>";
								head_contents 	+= "</div>";
								head_contents 	+= "</div>";
								head_contents 	+= "<br>";
								determine_head 	= 1;
			        		}
			        		

			        		contents 	+= "<div class='row'>";
			        		contents 	+= "<br>";
			        		contents   	+= "<div class=\"col-md-12\">";
			        		contents   	+= "<section class=\"call-to-action with-borders mb-xl\">";
			        		contents   	+= "<div class=\"row\">";

			        		contents   	+= "<div class=\"col-md-4\">";
			        		contents   	+= "<div class=\"call-to-action-content\">";
			        		contents   	+= "<h4>"+court_name+"</h4>";
			        		contents   	+= "<h6>"+court_address+"</h6>";
			        		contents   	+= "<small>";
			        		contents   	+= "Rating : ";
			        		contents   	+= "<i class=\"fa fa-star text-warning\"></i>";
			        		contents   	+= "<i class=\"fa fa-star text-warning\"></i>";
			        		contents   	+= "</small>";
			        		contents   	+= "</div>";
			        		contents   	+= "</div>";

			        		contents   	+= "<div class=\"col-md-3\">";
			        		contents   	+= "<div class=\"call-to-action-content\">";
			        		contents   	+= "<h5>Harga Promo</h5>";
			        		contents   	+= "<h4><span class=\"text-color-primary\">"+"Rp. "+promo_price+",-"+" / jam</span></h4>";
			        		contents   	+= "</div>";
			        		contents   	+= "</div>";

			        		contents   	+= "<div class=\"col-md-3\">";
			        		contents   	+= "<div class=\"call-to-action-content\">";
			        		contents   	+= "<h5>Berlaku Promo</h5>";
			        		contents   	+= "<small>"+date_start+" hingga "+date_end+"</small>";
			        		contents   	+= "</div>";
			        		contents   	+= "</div>";

			        		contents   	+= "<div class=\"col-md-2\">";
			        		contents   	+= "<div class=\"call-to-action-content\">";
			        		contents   	+= "<p>";
			        		contents   	+= "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
			        		contents   	+= "</p>";
			        		contents   	+= "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
			        		contents   	+= "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
			        		contents   	+= "</div>"; 
			        		contents   	+= "</div>"; 
			        		contents   	+= "<br>"; 
			        		contents   	+= "</section>";  
			        		contents   	+= "</div>"; 
			        		contents 	+= "</div>";
		        		}
		        		else if((JSONObject[key]["promo_state"])=="no")
		        		{

		        			var date_start 		= JSONObject[key]["date_start"];
			        		var date_end 		= JSONObject[key]["date_end"];
			        		var court_reg		= JSONObject[key]["court_reg"];
			        		var court_name 		= JSONObject[key]["court_name"];
			        		var court_address	= JSONObject[key]["court_address"];
			        		var promo_price 	= JSONObject[key]["promo_price"]; 

		        			$.ajax
		        			({
		        				type	: "POST",
								url		: "api_mf/development.php",
								data 	: "type=reqcalculateallfield",
								dataType: "JSON",
								cache 	: false,
								success	: function(JSONObject)
								{
									for(var key in JSONObject)
									{
										if(JSONObject.hasOwnProperty(key))
										{
											if((JSONObject[key]["type"])==="rescalculateallfield")
											{
												dataFieldCalculation = JSONObject[key]["total_field"];

								        		if(determine_head==0)
								        		{
								        			head_contents 	+= "<div class='row'>";

								        			head_contents 	+= "<div class='col-md-2'>";
								        			head_contents 	+= "&nbsp;";
								        			head_contents 	+= "</div>";

									        		head_contents 	+= "<div class='col-md-8'>";
									        		head_contents 	+= "<h2 style:\"text-align: center;\"> Statistik Lapangan Futsal Tergabung : <span class='label label-default'>"+dataFieldCalculation+" Lapangan Futsal </span></h2>";
									        		head_contents	+= "<hr>";
									        		head_contents	+= "<button class='btn btn-default mr-xs mb-sm' id='ref_lapangan'><strong>Referensikan Lapangan Favorite</strong></button> agar dapat kami bantu untuk dicantumkan di daftar lapangan Maufutsal";
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
									
		    						$("#promo_contents").html(head_contents+contents);
								}
		        			});
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
		}
	});
	return false;
}

function searchField()
{
	var autofield = document.getElementById('autofieldcity').value;
	var court_reg = [];
	var city_id = [];
	var count = 0;
	var state = 0;

	if(autofield=="")
	{
		getAllPromotionField();
	}
	else
	{
		var contents = "";

		$.ajax
		({
			type 	: "POST",
			url 	: "api_mf/development.php",
			data 	: "type=reqsearchfield"+"&key="+autofield,
			dataType: "JSON",
			cache 	: false,
			success	: function(JSONObject)
			{
				for(var key in JSONObject)
				{
					if (JSONObject.hasOwnProperty(key)) 
			        {
			        	if((JSONObject[key]["type"])=="ressearchfield")
			        	{
			        		if(JSONObject[key]["court_reg"]=="-")
			        		{
			        			var city_id_value = JSONObject[key]["id_kota"];
			        			city_id[count] = city_id_value;
			        			count++;
			        			state=1;
			        		}
			        		else
			        		{
			        			var court_reg_value = JSONObject[key]["court_reg"];
			        			court_reg[count] = court_reg_value;
			        			count++;
			        			state=0;
			        		}
			        	}
			        	else
			        	{
			        		//no from ressearchfield
			        	}
			        }
				}

				if(state==0)
				{
					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowfieldlistcourtreg"+"&court_reg="+court_reg,
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
						        	if((JSONObject[key]["type"])=="resshowfieldlistcourtreg")
						        	{
						        		var date_start 		= JSONObject[key]["date_start"];
						        		var date_end 		= JSONObject[key]["date_end"];
						        		var court_reg		= JSONObject[key]["court_reg"];
						        		var court_name 		= JSONObject[key]["court_name"];
						        		var court_address	= JSONObject[key]["court_address"];
						        		var promo_price 	= JSONObject[key]["promo_price"];
						        		var normal_price 	= JSONObject[key]["normal_price"]; 

						        		if(promo_price!="-")
						        		{
						        			contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-4\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+court_name+"</h4>";
							        		contents   += "<h6>"+court_address+"</h6>";
							        		contents   += "<small>";
							        		contents   += "Rating : ";
							        		contents   += "<i class=\"fa fa-star text-warning\"></i>";
							        		contents   += "<i class=\"fa fa-star text-warning\"></i>";
							        		contents   += "</small>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Promo</h5>";
							        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+promo_price+",-"+" / jam</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Berlaku Promo</h5>";
							        		contents   += "<small>"+date_start+" hingga "+date_end+"</small>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
							        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
							        		contents   += "</div>"; 
							        		contents   += "</div>"; 
							        		contents   += "<br>"; 
							        		contents   += "</section>";  
							        		contents   += "</div>"; 
						        		}


						        		if(normal_price!="-")
						        		{
						        			contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-4\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+court_name+"</h4>";
							        		contents   += "<h6>"+court_address+"</h6>";
							        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        	contents   += "Peta Lokasi";
								        	contents   += "</a>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Normal Mulai</h5>";
							        		contents   += "<h4><span class=\"text-color-default\">"+"Rp. "+normal_price+",-"+" / jam</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Berlaku Promo</h5>";
							        		contents   += "<small>tidak terdapat promo untuk saat ini</small>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";
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

						    $("#promo_contents").html(contents);
						}
					});
				}
				else if(state==1)
				{
					$.ajax
					({
						type 	: "POST",
						url 	: "api_mf/development.php",
						data 	: "type=reqshowfieldlistcityid"+"&city_id="+city_id,
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
						        	if((JSONObject[key]["type"])=="resshowfieldlistcityid")
						        	{
						        		var date_start 		= JSONObject[key]["date_start"];
						        		var date_end 		= JSONObject[key]["date_end"];
						        		var court_reg		= JSONObject[key]["court_reg"];
						        		var court_name 		= JSONObject[key]["court_name"];
						        		var court_address	= JSONObject[key]["court_address"];
						        		var promo_price 	= JSONObject[key]["promo_price"];
						        		var normal_price 	= JSONObject[key]["normal_price"]; 

						        		if(promo_price!="-")
						        		{
						        			contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-4\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+court_name+"</h4>";
							        		contents   += "<h6>"+court_address+"</h6>";
							        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        	contents   += "Peta Lokasi";
								        	contents   += "</a>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Promo</h5>";
							        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+promo_price+",-"+" / jam</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Berlaku Promo</h5>";
							        		contents   += "<small>"+date_start+" hingga "+date_end+"</small>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
							        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
							        		contents   += "</div>"; 
							        		contents   += "</div>"; 
							        		contents   += "<br>"; 
							        		contents   += "</section>";  
							        		contents   += "</div>"; 
						        		}


						        		if(normal_price!="-")
						        		{
						        			contents   += "<div class=\"col-md-12\">";
							        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
							        		contents   += "<div class=\"row\">";

							        		contents   += "<div class=\"col-md-4\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h4>"+court_name+"</h4>";
							        		contents   += "<h6>"+court_address+"</h6>";
							        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        	contents   += "Peta Lokasi";
								        	contents   += "</a>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Tarif Normal Mulai</h5>";
							        		contents   += "<h4><span class=\"text-color-default\">"+"Rp. "+normal_price+",-"+" / jam</span></h4>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-3\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<h5>Berlaku Promo</h5>";
							        		contents   += "<small>tidak terdapat promo untuk saat ini</small>";
							        		contents   += "</div>";
							        		contents   += "</div>";

							        		contents   += "<div class=\"col-md-2\">";
							        		contents   += "<div class=\"call-to-action-content\">";
							        		contents   += "<p>";
							        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
							        		contents   += "</p>";
							        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
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
						    $("#promo_contents").html(contents);
						}
					});
				}
				else
				{

				}
			}
		});
		return false;
	} // end of else
} // end of function


document.onkeydown=function(evt)
{
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;

    if(keyCode == 13)
    {
      	var autofield = document.getElementById('autofieldcity').value;
		var court_reg = [];
		var city_id = [];
		var count = 0;
		var state = 0;

		if(autofield=="")
		{
			getAllPromotionField();
		}
		else
		{
			var contents = "";

			$.ajax
			({
				type 	: "POST",
				url 	: "api_mf/development.php",
				data 	: "type=reqsearchfield"+"&key="+autofield,
				dataType: "JSON",
				cache 	: false,
				success	: function(JSONObject)
				{
					for(var key in JSONObject)
					{
						if (JSONObject.hasOwnProperty(key)) 
				        {
				        	if((JSONObject[key]["type"])=="ressearchfield")
				        	{
				        		if(JSONObject[key]["court_reg"]=="-")
				        		{
				        			var city_id_value = JSONObject[key]["id_kota"];
				        			city_id[count] = city_id_value;
				        			count++;
				        			state=1;
				        		}
				        		else
				        		{
				        			var court_reg_value = JSONObject[key]["court_reg"];
				        			court_reg[count] = court_reg_value;
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
						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowfieldlistcourtreg"+"&court_reg="+court_reg,
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
							        	if((JSONObject[key]["type"])=="resshowfieldlistcourtreg")
							        	{
							        		var date_start 		= JSONObject[key]["date_start"];
							        		var date_end 		= JSONObject[key]["date_end"];
							        		var court_reg		= JSONObject[key]["court_reg"];
							        		var court_name 		= JSONObject[key]["court_name"];
							        		var court_address	= JSONObject[key]["court_address"];
							        		var promo_price 	= JSONObject[key]["promo_price"];
							        		var normal_price 	= JSONObject[key]["normal_price"]; 

							        		if(promo_price!="-")
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h4>"+court_name+"</h4>";
								        		contents   += "<h6>"+court_address+"</h6>";
								        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        		contents   += "Peta Lokasi";
								        		contents   += "</a>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Tarif Promo</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+promo_price+",-"+" / jam</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Berlaku Promo</h5>";
								        		contents   += "<small>"+date_start+" hingga "+date_end+"</small>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
								        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>"; 
							        		}


							        		if(normal_price!="-")
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h4>"+court_name+"</h4>";
								        		contents   += "<h6>"+court_address+"</h6>";
								        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        		contents   += "Peta Lokasi";
								        		contents   += "</a>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Tarif Normal Mulai</h5>";
								        		contents   += "<h4><span class=\"text-color-default\">"+"Rp. "+normal_price+",-"+" / jam</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Berlaku Promo</h5>";
								        		contents   += "<small>tidak terdapat promo untuk saat ini</small>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";
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

							    $("#promo_contents").html(contents);
							}
						});
					}
					else if(state==1)
					{
						$.ajax
						({
							type 	: "POST",
							url 	: "api_mf/development.php",
							data 	: "type=reqshowfieldlistcityid"+"&city_id="+city_id,
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
							        	if((JSONObject[key]["type"])=="resshowfieldlistcityid")
							        	{
							        		var date_start 		= JSONObject[key]["date_start"];
							        		var date_end 		= JSONObject[key]["date_end"];
							        		var court_reg		= JSONObject[key]["court_reg"];
							        		var court_name 		= JSONObject[key]["court_name"];
							        		var court_address	= JSONObject[key]["court_address"];
							        		var promo_price 	= JSONObject[key]["promo_price"];
							        		var normal_price 	= JSONObject[key]["normal_price"]; 

							        		if(promo_price!="-")
							        		{
							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h4>"+court_name+"</h4>";
								        		contents   += "<h6>"+court_address+"</h6>";
								        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        		contents   += "Peta Lokasi";
								        		contents   += "</a>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Tarif Promo</h5>";
								        		contents   += "<h4><span class=\"text-color-primary\">"+"Rp. "+promo_price+",-"+" / jam</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Berlaku Promo</h5>";
								        		contents   += "<small>"+date_start+" hingga "+date_end+"</small>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
								        		contents   += "<button class=\"btn btn-sm btn-default\">Pelajari Selengkapnya</button>"; 
								        		contents   += "</div>"; 
								        		contents   += "</div>"; 
								        		contents   += "<br>"; 
								        		contents   += "</section>";  
								        		contents   += "</div>"; 
							        		}


							        		if(normal_price!="-")
							        		{

							        			contents   += "<div class=\"col-md-12\">";
								        		contents   += "<section class=\"call-to-action with-borders mb-xl\">";
								        		contents   += "<div class=\"row\">";

								        		contents   += "<div class=\"col-md-4\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h4>"+court_name+"</h4>";
								        		contents   += "<h6>"+court_address+"</h6>";
								        		contents   += "<a id=\"maps"+count+"\" style=\"cursor:pointer\">";
								        		contents   += "Peta Lokasi";
								        		contents   += "</a>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Tarif Normal Mulai</h5>";
								        		contents   += "<h4><span class=\"text-color-default\">"+"Rp. "+normal_price+",-"+" / jam</span></h4>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-3\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<h5>Berlaku Promo</h5>";
								        		contents   += "<small>tidak terdapat promo untuk saat ini</small>";
								        		contents   += "</div>";
								        		contents   += "</div>";

								        		contents   += "<div class=\"col-md-2\">";
								        		contents   += "<div class=\"call-to-action-content\">";
								        		contents   += "<p>";
								        		contents   += "<button id=\"reserv"+count+"\" class=\"btn btn-lg btn-warning\">Pesan Sekarang</button>";
								        		contents   += "</p>";
								        		contents   += "<input type=\"hidden\" value="+court_reg+" autocomplete=\"off\" readonly id=\"coreg"+count+"\" />";	
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

							    $("#promo_contents").html(contents);
							}
						});
					}
					else
					{

					}
				}
			});
			return false;
		} // end of else
    }
}