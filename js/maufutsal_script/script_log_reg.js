$(document).ready(function()
{
	$("#registration").click(registration);
	$("#login").click(login_check);
	$("#registration_now").click(showRegForm);
	$("#forgot").click(showForgotForm);
	$("#logout").click(logout);
});


function registration()
{
	var username 	= document.getElementById('username').value;
	var mail 		= document.getElementById('mail').value;
	var password 	= document.getElementById('pass').value;
	var cat			= $('input[name="genre"]:checked').val();

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
							location.reload();
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

	document.getElementById('username').value="";
	document.getElementById('mail').value="";
	document.getElementById('pass').value="";
	$('input[name="genre"]').removeAttr("checked");
	$('#modalReg').modal('hide');
	return false;
}


function login_check()
{
	var username 	= document.getElementById('mail_login').value;
	var password 	= document.getElementById('pass_login').value;

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
							//swal("Anda berhasil login", "", "success");
							document.getElementById('mail_login').value="";
							document.getElementById('pass_login').value="";
							//$('#modalLogin').modal('hide');
							location.reload();
							//window.location.reload();
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

function showRegForm()
{
	$('#modalLogin').modal('hide');
	$('#modalReg').modal('show');
}

function showForgotForm()
{
	$('#modalLogin').modal('hide');
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
	document.getElementById('menuLogin').style.display = 'none';
	document.getElementById('menuRegistration').style.display = 'none';
}

function showSomeMenu()
{
	$('#menuLogin').show();
	$('#menuRegistration').show();
}