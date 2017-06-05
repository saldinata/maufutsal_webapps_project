<?php
    
include ('../components/connection.php');


$email      = htmlentities(addslashes($_POST["email"]));
$password   = htmlentities(addslashes($_POST["password"]));
$level      = null;

$ecryptPass = md5($password);

//jika form tidak di input maka tampil warning
if (empty($password) || empty($email)) 
{
    echo "emptyForm";
}
else
{   
    // jika email tidak valid maka tampil warning
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      echo "EmailnotValid";
    }
    else
    {
        $cekEmail = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$email'");
        $resultEmail = mysqli_num_rows($cekEmail);

        // jika username dengan email yang di input tidak ada di DB maka tampil warning
        if ($resultEmail < 1)
        {
            echo "notRegister";
        }
        else
        {
            $cekPass = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$email' AND password='$ecryptPass'");
            $resultPass = mysqli_num_rows($cekPass);

            // jika password yang di input tidak sesuai DB maka tampil warning
            if ($resultPass < 1) 
            {
                echo "wrongPass";
            }
            else
            {
                $cekAktivasi = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$email' AND password='$ecryptPass' 
                                            AND status_aktivasi='1'");
                $resultAktivasi = mysqli_num_rows($cekAktivasi);

                // jika 
                if ($resultAktivasi < 1) 
                {
                    echo "notActive";
                }
                else
                {
                    $cekLogin = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$email' AND password='$ecryptPass' 
                                            AND status_aktivasi='1'");
                    $resultLogin = mysqli_num_rows($cekLogin);


                    while($getAuntentification = mysqli_fetch_object($cekLogin))
                    {
                        if($getAuntentification)
                        {
                            session_start();
                            $level                  = $getAuntentification->level;
                            $_SESSION['username']   = $getAuntentification->username;
                            $_SESSION['idreg']      = $getAuntentification->id_reg;
                        }
                        else
                        {
                            $level = null;
                        }
                    }
                }
            }
        }
    }
    
}
echo $level;
?>