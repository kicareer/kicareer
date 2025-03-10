<?php


    $email_data = "Demo text<br>";
  
  // Email
  
      $send_email_to="mahesh81369@gmail.com";
      require 'phpmailer/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->isSMTP();
    //  $mail->SMTPDebug  = 1;
      $mail->Host = 'mail.adviitsolutions.com';  
      $mail->SMTPAuth = true;                    
      $mail->Username = 'info@adviitsolutions.com'; 
      $mail->Password = 'vb917FSwJ).d'; 
      $mail->SMTPSecure = 'non-SSL';                  
      $mail->Port = 26;
      $mail->setFrom('info@adviitsolutions.com','One Global');
      $mail->addAddress($send_email_to);
      $mail->isHTML(true);

      $mail->Subject='New Contact Enquiry  - Date'.date('d/m/Y');
      $mail->Body=$email_data;
       if ($mail->send()){
        
       }else{
          echo 'Failed: ' . $mail->ErrorInfo;
        }
        
        
        ?>