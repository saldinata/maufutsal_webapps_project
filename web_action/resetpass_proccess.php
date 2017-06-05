<?php

      include ('../components/connection.php');
      
      $email      = htmlentities(addslashes($_POST["email"]));

      if (empty($email)) 
      {
          echo "emptyForm";
      }
      else
      {   
          if (!filter_var($email, FILTER_VALIDATE_EMAIL))
          {
              echo "notValid";
          }
          else
          {
              $cekAkun = mysqli_query($con, "SELECT username FROM tbl_user WHERE username='$email'");
              $jlhAkun = mysqli_num_rows($cekAkun);

              if ($jlhAkun < 1)
              {
                  echo "notRegister";
              }
              else 
              {
                  
                  $encryptPass      = uniqid(rand());
                  $password         = md5($encryptPass);
                  $subject          = "Reset Password Maufutsal";
                  $message          = "Password baru anda : ".$encryptPass;
                  $headers          = 'From: Maufutsal <info@maufutsal.com>'."\r\n";


                  $sql = mysqli_query($con,"UPDATE tbl_user SET password='$password' WHERE username='$email'");

                  if ($sql) 
                  {
                      $sendmail = mail($email, $subject, $message, $headers);

                      if ($sendmail) 
                      {
                        echo "1";
                      }
                      else
                      {
                        echo "0";
                      }
                  }

                  else
                  {
                      echo "Failed";
                  }
                  
              }
          }
          
      }
      

?>