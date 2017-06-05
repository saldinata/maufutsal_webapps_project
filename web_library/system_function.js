<script type="text/javascript">

    function cekLogin() 
    {
        var email       = $("#email").val();
        var password    = $("#password").val();

        $.ajax
        ({
            type    : "POST",
            url     : "../web_action/login_proccess.php",
            data    : "email=" + email + "&password=" + password,
            success : function(data) 
            {

                if (data == 'emptyForm') 
                {
                    swal("Ops!", "Harap masukkan email dan password anda.", "warning");
                    // alert ("Harap masukkan email dan password anda");
                }
                else if (data == 'EmailnotValid') 
                {
                    swal("Ops!", "Email tidak valid (JohnDoe@gmail.com)", "warning");
                    // alert ("Email tidak valid");
                    //$("#email").val("");
                }
                else if (data == 'notRegister') 
                {
                    swal("Ops!", "Email yang anda masukkan belum terdaftar.", "error");
                    //alert ("Maaf, Akun belum terdaftar");
                }
                else if (data == 'wrongPass') 
                {
                    swal("Maaf!", "Password anda salah.", "warning");
                    //alert ("Maaf, Password Anda Salah");
                    $("#email").val('');
                    $("#password").val('');
                }
                else if (data == 'notActive') 
                {
                    swal("Akun anda belum aktif!", "Silahkan aktivasi akun anda.", "error");
                    $("#email").val('');
                    $("#password").val('');
                }
                else if (data == 'admin') 
                {
                    document.location.href="../demo/main";
                    //window.location = "http://www.maufutsal.com/demo/main";
                }

                else if (data=='ownerfield') 
                {
                    document.location.href="../demo/main";
                    //window.location = "http://www.maufutsal.com/demo/main";
                }

                else if (data == 'member') 
                {
                    document.location.href="../demo/main.php";
                    //window.location = "http://www.maufutsal.com/demo/main";
                }

                else if (data == 'eo') 
                {
                    document.location.href="../demo/main";
                    //window.location = "http://www.maufutsal.com/demo/main";
                }
            }
        });

        return false; 
    }


    function clearForm()
    {
        $("#nama").val("");
        $("#email").val("");
        $("#pass1").val("");
        $("#pass2").val("");
        $("#genre").val("");
        $("#role1").prop("checked",false);
        $("#role2").prop("checked",false);
        $("#role3").prop("checked",false);
    }


    function cekRegister()
    {

        var nama    = $("#nama").val();
        var email   = $("#email").val();
        var pass1   = $("#pass1").val();
        var pass2   = $("#pass2").val();
        var genre   = $("#genre").val();
        var level   = $('input:radio[name=level]:checked').val();


            $.ajax({
                type    : "POST",
                url     : "../web_action/register_proccess.php",
                data    : "nama=" + nama + "&email=" + email + "&pass1=" + pass1 + "&pass2=" + pass2 + "&genre=" + genre + "&level=" + level,
                cache   : false,
                success : function(data) 
                {
                    // if (data == 'emptyAllForm') 
                    // {
                    //    // $("#myModal").modal();
                    //     // alert("Harap isi semua form !!!");
                    //     $(".empty-nama").show();
                    //     $(".empty-email").show();
                    //     $(".empty-password").show();
                    //     $(".empty-retypepassword").show();
                    //     $(".empty-role").show();
                    // }

                    // else if (data == 'emptyNama') 
                    // {
                    //     $(".empty-nama").show();
                    //     $(".empty-email").hide();
                    //     $(".empty-password").hide();
                    //     $(".empty-retypepassword").hide();
                    //     $(".empty-role").hide();
                    // }

                    // else if (data == 'emptyEmail') 
                    // {
                    //     $(".empty-nama").hide();
                    //     $(".empty-email").show();
                    //     $(".empty-password").hide();
                    //     $(".empty-retypepassword").hide();
                    //     $(".empty-role").hide();
                    // }

                    // else if (data == 'emptyPassword') 
                    // {
                    //     $(".empty-email").hide();
                    //     $(".empty-nama").hide();
                    //     $(".empty-password").show();
                    //     $(".empty-retypepassword").hide();
                    //     $(".empty-role").hide();
                    // }

                    // else if (data == 'emptyRetypePassword') 
                    // {
                    //     $(".empty-email").hide();
                    //     $(".empty-nama").hide();
                    //     $(".empty-password").hide();
                    //     $(".empty-retypepassword").show();
                    //     $(".empty-role").hide();
                    // }

                    // else if (data == 'emptyRole') 
                    // {
                    //     $(".empty-email").hide();
                    //     $(".empty-nama").hide();
                    //     $(".empty-password").hide();
                    //     $(".empty-retypepassword").hide();
                    //     $(".empty-role").show();
                    // }

                    // else if (data == 'emptyRole') 
                    // {
                    //     swal("Maaf!", "Silahkan pilih role anda.", "warning");
                    //     //alert("Silahkan pilih role anda !!!");
                    //     //clearForm();
                    // }
                    // else if (data == 'emptyGenre') 
                    // {
                    //     swal("Maaf!", "Silahkan pilih genre anda.", "warning");
                    //     //alert("Silahkan Pilih Genre");
                    // }

                    if (data == 'emptyOneForm') 
                    {
                        $("#empty-form").show();
                        $(".empty-role").hide();
                        $(".empty-genre").hide();
                        $(".email-not-valid").hide();
                        $(".length-password").hide();
                        $(".not-same-pass").hide();
                    }
                    else if (data == 'emptyRole') 
                    {
                        $(".empty-role").show();
                        $("#empty-form").hide();
                        $(".email-not-valid").hide();
                        $(".length-password").hide();
                        $(".not-same-pass").hide();
                    }
                    else if (data == 'emptyGenre') 
                    {
                        $(".empty-genre").show();
                        $(".email-not-valid").hide();
                        $("#empty-form").hide();
                        $(".length-password").hide();
                        $(".not-same-pass").hide();
                        $(".empty-role").hide();
                    }
                    
                    else if (data == 'emailValidation') 
                    {
                        $(".email-not-valid").show();
                        $("#empty-form").hide();
                        $(".length-password").hide();
                        $(".not-same-pass").hide();
                        $(".empty-genre").hide();
                        $(".empty-role").hide();
                    }
                    else if (data == 'minlengthPass') 
                    {   
                        $(".length-password").show();
                        $(".email-not-valid").hide();
                        $("#empty-form").hide();
                        $(".not-same-pass").hide();
                        $(".empty-genre").hide();
                        $(".empty-role").hide();
                    }
                    else if (data == 'differentPass') 
                    {
                        $(".not-same-pass").show();
                        $(".length-password").hide();
                        $(".email-not-valid").hide();
                        $("#empty-form").hide();
                        $(".empty-genre").hide();
                        $(".empty-role").hide();
                    }
                    else if (data == 'readyEmail') 
                    {
                        swal("Maaf!", "Email sudah terdaftar.", "warning");
                    }
                    else if (data == 1) 
                    {
                        swal({   
                          title: "Pendaftaran berhasil!",   
                          text: "Klik link aktvasi yang telah kami kirim ke email anda untuk melakukan aktivasi akun",   
                          type: "success",   
                          showCancelButton: false,   
                          confirmButtonColor: "#DD6B55",   
                          confirmButtonText: "OK",   
                          closeOnConfirm: false 
                        }, 
                        function(){   
                          window.location.href="http://www.kitaaja.maufutsal.com/"; 
                        }
                        );
                    }
                    else if (data == 0) 
                    {
                        alert("Gagal Registrasi");
                        clearForm();
                    }
                }
            });
            return false;
    }
    
    function resetPassword() 
    {

        var email       = $("#email").val();

        $.ajax
        ({
            type    : "POST",
            url     : "../web_action/resetpass_proccess.php",
            data    : "email=" + email,
            success : function(data) 
            {

                if (data == 'emptyForm') 
                {
                    swal("Maaf!", "Harap isi email anda.", "warning");
                }
                else if (data == 'notValid') 
                {
                    swal("Maaf!", "Email tidak valid (example@gmail.com)", "warning");
                }
                else if (data == 'notRegister') 
                {
                    swal("Maaf!", "Email anda belum terdaftar.", "warning");
                    $("#email").val("");                      
                }
                else if (data == 1) 
                {
                    swal({   
                      title: "Success",   
                      text: "Password baru telah kami kirim ke email anda.",   
                      type: "success",   
                      showCancelButton: false,   
                      confirmButtonText: "OK",   
                      closeOnConfirm: false 
                    }, 
                    function(){   
                      document.location.href="http://www.maufutsal.com/login"; 
                    }
                    );
                    //swal("Send!", "Password baru telah kami kirim ke email anda.", "success");
                    $("#email").val("");
                }
                else
                {
                    alert("Reset Password gagal dikirim");
                }
            }
        });

        return false; 
    }

    $(document).ready(function()
    {
        $("#btnLogin").click(cekLogin);

        $("#btnRegister").click(cekRegister);

        $("#genre").hide();

        $(".empty-role").hide();

        $(".empty-genre").hide();

        $("#empty-form").hide();

        $(".email-not-valid").hide();

        $(".length-password").hide();

        $(".not-same-pass").hide();

        $("#role2").click(function(){
            $("#genre").show();
            $(".empty-role").hide();
        });
        $("#role1").click(function(){
            $("#genre").hide();
            $(".empty-genre").hide();
        });
        $("#role3").click(function(){
            $("#genre").hide();
            $(".empty-genre").hide();
        });
        
        $("#btnResetPass").click(resetPassword);
            

    });

</script>