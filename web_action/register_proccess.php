<?php

include ('../components/connection.php');
require_once('../library/utility.php');

$util       = new Utility();
$nama       = htmlentities(addslashes($_POST["nama"]));
$email      = htmlentities(addslashes($_POST["email"]));
$pass1      = htmlentities(addslashes($_POST["pass1"]));
$pass2      = htmlentities(addslashes($_POST["pass2"]));
$genre      = htmlentities(addslashes($_POST["genre"]));
$level      = htmlentities(addslashes($_POST["level"]));

    
    // if (empty($nama) && empty($email) && empty($pass1) && empty($pass2) && ($level != "ownerfield") && ($level != "member") && ($level != "eo"))
    // {
    //     echo "emptyAllForm";
    // }
    // else if ( empty($nama) && !empty($email) && !empty($pass1) && !empty($pass2) && !empty($level))
    // {
    //     echo "emptyNama";
    // }
    // else if ( !empty($nama) && empty($email) && !empty($pass1) && !empty($pass2) && !empty($level))
    // {
    //     echo "emptyEmail";
    // }
    // else if ( !empty($nama) && !empty($email) && empty($pass1) && !empty($pass2) && !empty($level))
    // {
    //     echo "emptyPassword";
    // }
    // else if ( !empty($nama) && !empty($email) && !empty($pass1) && empty($pass2) && !empty($level))
    // {
    //     echo "emptyRetypePassword";
    // }
    // else if ( !empty($nama) && !empty($email) && !empty($pass1) && !empty($pass2) && ($level != "ownerfield") && ($level != "member") && ($level != "eo"))
    // {
    //     echo "emptyRole";
    // }

    if (empty($nama) || empty($email) || empty($pass1) || empty($pass2)) 
    {
        echo "emptyOneForm";
    }
    else
    {
         if (($level != "ownerfield") && ($level != "member") && ($level != "eo")) 
        {
            echo "emptyRole";
        }
        else
        {
            if ($level=="member" && empty($genre))  
            {
                echo "emptyGenre";
            }
            else
            {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    echo "emailValidation";
                }
                else
                {
                    if (strlen($pass1) < 6)
                    {
                        echo "minlengthPass";
                    }
                    else
                    {
                        if ($pass1 != $pass2) 
                        {
                            echo "differentPass";
                        }
                        else
                        {
                            $cekdata = mysqli_query($con,"SELECT username FROM tbl_user WHERE username='$email'");
                            $result = mysqli_num_rows($cekdata);

                            if ($result >= 1) 
                            {
                                echo "readyEmail";
                            }
                            else
                            {
                                $combination_one    = date("Ymd");
                                $combination_two    = time();
                                $id_reg             = $combination_one.$combination_two;
                                $state              = "0";
                                $encrpt_pass        = $util->encode($pass1);
                                #$encrpt_pass        = md5($pass1);

                                $kode       = md5(uniqid(rand()));
                                $status     = "0";
                                $subject    = "Aktivasi Akun Maufutsal";
                                $message    = "Member yang terhormat,"."\r\n\r\n";
                                $message    .= "Email anda sudah didaftarkan sebagai akun Maufutsal. Untuk mengaktifkan akun Maufutsal anda, Silahkan klik link aktivasi berikut ini: "."\r\n\r\n";
                                $message    .= "http://www.maufutsal.com/activation/aktivasi.php?kode=$kode"."\r\n\r\n";
                                $message    .= "Salam,"."\r\n\r\n";
                                $message    .= "Maufutsal Team"."\r\n\r\n";
                                
                                $headers = 'From: Maufutsal <info@maufutsal.com>'."\r\n";
                                $headers.="MIME-Version: 1.0\n";
                                $headers.="Content-type: text/html; charset=iso 8859-1";
                               
                                $query = mysqli_query($con,"INSERT INTO tbl_user (
                                                        name,username,password,level,genre,id_reg,state,kode_aktivasi,status_aktivasi)
                                                        VALUES ('$nama','$email','$encrpt_pass','$level','$genre','$id_reg','$state',
                                                        '$kode','$status')");

                                if($query) 
                                {
                                    mail($email, $subject, $message, $headers,"-finfo@maufutsal.com");
                                    echo "1";
                                } 
                                else 
                                {
                                    echo "0";
                                }
                            }
                        }
                    }
                }
            }
        }
    } 

?>