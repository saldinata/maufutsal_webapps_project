$(document).ready(function() 
{
    $("#forgot_pass").click(showDialogForgot);
    $("#change_pass").click(doChangePass);
    $("#reset_pass").click(doResetPass);
});

function doResetPass()
{
   var mail = document.getElementById('mail_forgot').value;
   $.ajax
    ({
        type    : "POST",
        url     : "api_mf/development.php",
        data    : "type=reqrespass"+"&mail="+mail,
        dataType: "JSON",
        cache   : false,
        success : function(JSONObject)
        {
            for (var key in JSONObject)
            {
                if(JSONObject.hasOwnProperty(key))
                {
                    if(JSONObject[key]["type"]==="resrespass")
                    {
                        if(JSONObject[key]["success"]==true)
                        {
                            document.getElementById('mail_forgot').value="";
                            $("#modalForgot").modal('hide');
                            swal('Berhasil', 'Kata kunci terbaru dikirim melalui email : '+mail +'. Apabila tidak ada dalam inbox, kemungkinan email berada di dalam kotak spam','success');
                        }
                        else
                        {
                            swal('Oppps', 'Sepertinya alamat email tidak terdapat dalam system. Mohon periksa kembali','error');
                        }
                    }
                }
            }
        }
    });

    return false;
}



function showDialogForgot()
{
    $('#modalForgot').modal('show');
}


function doChangePass()
{
    var oldPass = document.getElementById('oldpass').value;
    var newPass = document.getElementById('newpass').value;

    $.ajax
    ({
        type    : "POST",
        url     : "api_mf/development.php",
        data    : "type=reqchangepass"+"&oldpass="+oldPass+"&newpass="+newPass,
        dataType: "JSON",
        cache   : false,
        success : function(JSONObject)
        {
            for (var key in JSONObject)
            {
                if(JSONObject.hasOwnProperty(key))
                {
                    if(JSONObject[key]["type"]==="reschangepass")
                    {
                        if(JSONObject[key]["success"]==="true")
                        {
                            document.getElementById('oldpass').value="";
                            document.getElementById('newpass').value="";
                            swal('Berhasil', 'pergantian kata kunci sukses','success');
                        }
                        else
                        {
                            swal('Oppps', 'Mohon periksa kembali pengetikan','error');
                        }
                    }
                }
            }
        }
    });

    return false;

}

