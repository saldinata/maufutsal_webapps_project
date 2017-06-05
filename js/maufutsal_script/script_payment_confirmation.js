var id_booking 	= "";
var id_reg 		= "";

$(document).ready(function()
{
	$("#save_resconfirm").click(saveResConfirm);
	$("#save_regconfirm").click(saveRegConfirm);
});

$(document).on("click", "button[id^=resconf]",showDialogConfirmRes);
$(document).on("click", "button[id^=regconf]",showDialogConfirmReg);
// $(document).on("click", "button[id^=prereg]",showDialogPreReg);
// $(document).on("click", "button[id^=preres]",showDialogPreRes);


function showDialogConfirmRes()
{
	var numbering 	= parseInt(this.id.replace("resconf", ""), 10);
	id_booking 		= $("#idbook"+numbering).val();

	$('#modalReservConf').modal('show');
}

function showDialogConfirmReg()
{
	var numbering 	= parseInt(this.id.replace("regconf", ""), 10);
	id_reg 		= $("#idreg"+numbering).val();

	$('#modalRegistrationConf').modal('show');
}


function saveResConfirm()
{
	 var date_transfer_reserv	= document.getElementById('date_transfer_reserv').value;
	 var time_transfer_reserv	= document.getElementById('time_transfer_reserv').value;
	 var bank_name_reserv		= document.getElementById('bank_name_reserv').value;
	 var account_name_reserv	= document.getElementById('account_name_reserv').value;

	 $.ajax
	 ({
	 		type 	: "POST",
	 		url 	: "api_mf/development.php",
	 		data 	: "type=reqsaveresconfirm"+"&date_transfer="+date_transfer_reserv+"&time_transfer="+time_transfer_reserv+"&bank_name="+bank_name_reserv+"&account_name_reserv="+account_name_reserv+"&id_booking="+id_booking,
	 		dataType: "JSON",
	 		cache 	: false,
	 		success : function(JSONObject)
	 		{
	 			for(var key in JSONObject )
	 			{
	 				if(JSONObject[key]["type"]==="ressaveresconfirm")
	 				{
	 					if(JSONObject[key]["success"]==="true")
	 					{
	 						swal("Konfirmasi Berhasil","","success");
	 						location.reload();
	 					}
	 				}
	 			}
	 		}
	 });
	 return false;
}


function saveRegConfirm()
{
	 var date_transfer_reserv	= document.getElementById('date_transfer_comp').value;
	 var time_transfer_reserv	= document.getElementById('time_transfer_comp').value;
	 var bank_name_reserv		= document.getElementById('bank_name_comp').value;
	 var account_name_reserv	= document.getElementById('account_name_comp').value;

	 $.ajax
	 ({
	 		type 	: "POST",
	 		url 	: "api_mf/development.php",
	 		data 	: "type=reqsaveregconfirm"+"&date_transfer="+date_transfer_reserv+"&time_transfer="+time_transfer_reserv+"&bank_name="+bank_name_reserv+"&account_name_reserv="+account_name_reserv+"&id_reg="+id_reg,
	 		dataType: "JSON",
	 		cache 	: false,
	 		success : function(JSONObject)
	 		{
	 			for(var key in JSONObject )
	 			{
	 				if(JSONObject[key]["type"]==="ressaveregconfirm")
	 				{
	 					if(JSONObject[key]["success"]==="true")
	 					{
	 						swal("Konfirmasi Berhasil","","success");
	 						location.reload();
	 					}
	 				}
	 			}
	 		}
	 });
	 return false;
}