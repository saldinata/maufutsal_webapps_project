$(document).ready(function()
{
	$("#registration_payment").click(registration_payment);
	$("#login_payment").click(login_check_payment);
	$("#registration_now_payment").click(showRegFormForPaymentStep);
	$("#go_to_phnumber_payment").click(gotoPaymentByNumberPhone);
});



function gotoPaymentByNumberPhone()
{
	var phoneNumber 	= document.getElementById('phnumber_login_payment').value;
	var current_date 	= document.getElementById('reserv_date').value;
	var court_reg		= document.getElementById('court_reg').value;
	var field_code		= document.getElementById('arena_name').value;
	var code_cat 		= document.getElementById('category').value;
	var start_time		= document.getElementById('reserv_time').value;
	var duration_time	= document.getElementById('timeusage').value;
	var cost 			= cost_temp;
	var state 			= state_temp;

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqpaymentpagenologin"+"&current_date="+current_date+"&court_reg="+court_reg+"&field_code="+field_code+"&code_cat="+code_cat+"&start_time="+start_time+"&duration_time="+duration_time+"&cost="+cost+"&state="+state+"&phnum="+phoneNumber,
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="respaymentpagenologin")
					{ 	
						if(JSONObject[key]["warning"]==="true")
						{
							swal("Oops !", "Tarif Rp.0,- atau status unavailable tidak dapat direservasi", "error");
						}
						else if(JSONObject[key]["warning"]==="false")
						{
							document.getElementById('phnumber_login_payment').value="";

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
	return false;
}



function registration_payment()
{
	var username 	= document.getElementById('username_payment').value;
	var mail 		= document.getElementById('mail_payment').value;
	var password 	= document.getElementById('pass_payment').value;
	//var cat			= $('input[name="genre"]:checked').val();

	var cat = "";
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
           cat = c.substring(name.length,c.length);
        }
    }

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqstoregmember"+"&username="+username+"&mail="+mail+"&pass="+password+"&cat="+cat,
		dataType: "JSON",
		cache	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="resstoregmember")
					{
						if(JSONObject[key]["registered"]==="false")
						{
							swal("Terima Kasih", "Pendaftaran akun berhasil dilakukan. Untuk aktivasi akun, mohon check email yang telah didaftarkan.", "success");
							var current_date 	= document.getElementById('reserv_date').value;
							var court_reg		= document.getElementById('court_reg').value;
							var field_code		= document.getElementById('arena_name').value;
							var code_cat 		= document.getElementById('category').value;
							var start_time		= document.getElementById('reserv_time').value;
							var duration_time	= document.getElementById('timeusage').value;
							var cost 			= cost_temp;
							var state 			= state_temp;

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
													document.getElementById('username_payment').value="";
													document.getElementById('mail_payment').value="";
													document.getElementById('pass_payment').value="";

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
							return false;
						}
						else
						{
							swal("Opps!", "Sepertinya alamat email telah terdaftar", "warning");
						}
					}
				}
			}
			
		}
	});

	// document.getElementById('username_payment').value="";
	// document.getElementById('mail_payment').value="";
	// document.getElementById('pass_payment').value="";
	// $('input[name="genre"]').removeAttr("checked");
	// $('#modalReg').modal('hide');
	return false;
}


function login_check_payment()
{
	var username 	= document.getElementById('mail_login_payment').value;
	var password 	= document.getElementById('pass_login_payment').value;
	var code_cat 	= document.getElementById('category').value;

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqchecklogin"+"&username="+username+"&password="+password,
		dataType: "JSON",
		cache	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="reschecklogin")
					{
						if(JSONObject[key]["registered"]==="false")
						{
							swal("Oops !", "Mohon check kembali pengetikan alamat email dan password. Klik tombol 'Lupa kata sandi' untuk me-reset password. ", "error");
						}
						else
						{
							var code_cat_db = JSONObject[key]["genre"];
							if(code_cat==code_cat_db)
							{
								//swal("Anda berhasil login", "", "success");
								document.getElementById('mail_login_payment').value="";
								document.getElementById('pass_login_payment').value="";
								//$('#modalLogin').modal('hide');
								//location.reload();
								//window.location.reload();

								var current_date 	= document.getElementById('reserv_date').value;
								var court_reg		= document.getElementById('court_reg').value;
								var field_code		= document.getElementById('arena_name').value;
								var code_cat 		= document.getElementById('category').value;
								var start_time		= document.getElementById('reserv_time').value;
								var duration_time	= document.getElementById('timeusage').value;
								var cost 			= cost_temp;
								var state 			= state_temp;

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
								return false;
							}
							else
							{
								location.reload();
							}
						}
					}
				}
			}
			
		}
	});
	return false;
}

function logout()
{
	var email = document.getElementById('email_data').value;

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqlogout"+"&email="+email,
		dataType: "JSON",
		cache	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="reslogout")
					{
						if(JSONObject[key]["success"]==="true")
						{
							//swal("Logout Berhasil", "", "success");
							location.reload();
						}
						else
						{
							swal("Sepertinya ada kesalahan", "", "error");
						}
					}
				}
			}
			
		}
	});
	return false;
}

function showRegFormForPaymentStep()
{
	$('#modalLoginPayment').modal('hide');
	$('#modalRegPayment').modal('show');
}

function showForgotForm()
{
	$('#modalLoginPayment').modal('hide');
	$('#modalForgot').modal('show');
}

function hideUserInfo()
{
	document.getElementById('userInfo').style.display = 'none';
}

function showUserInfo()
{
	$('#userInfo').show();
}

function hideSomeMenu()
{
	document.getElementById('menuLoginPayment').style.display = 'none';
	document.getElementById('menuRegistration').style.display = 'none';
}

function showSomeMenu()
{
	$('#menuLoginPayment').show();
	$('#menuRegistration').show();
}