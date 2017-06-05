var methodpayment = "";
var type_transfer = "";

$(document).ready(function() 
{
	hideTransferType();
	$('#payment_now').click(paymentnow);
	$('#type_transfer').change(gettypetransfer);

	$("input[name=payment]:radio").change(function() 
	{
        methodpayment = $(this).val();

        if(methodpayment==0)
        {
        	showTransferType();
        }
        else
        {
        	hideTransferType();
        }
    });
});


function gettypetransfer()
{
	type_transfer = $('#type_transfer').val();
}


function paymentnow()
{
	var page = document.getElementById('page').value;

	$.ajax
	({
		type 	: "POST",
		url		: "api_mf/development.php",
		data	: "type=reqstorebooking"+"&methodpayment="+methodpayment+"&type_transfer="+type_transfer+"&page="+page,
		dataType: "JSON",
		cache 	: false,
		success	: function(JSONObject)
		{
			for(var key in JSONObject)
			{
				if(JSONObject.hasOwnProperty(key))
				{
					if(JSONObject[key]["type"]==="resstorebooking")
					{
						var link = JSONObject[key]["link"];
						document.location.href= link;
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


function hideTransferType()
{
	$('#transfer_type').hide();
}


function showTransferType()
{
	$('#transfer_type').show();
}

