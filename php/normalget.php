<?php
include ("./connections.php");

$sys_id = $_POST['sys_id'];
$state = $_POST['state'];

    $query = mysqli_query($connections, "SELECT * FROM ssr_snow WHERE sys_id='$sys_id';");
    $row = mysqli_fetch_assoc($query);
    $old_state = $row['state'];
    $dxcssr = $row['dxc_ssr'];
    $number = $row['number'];

    $query2 = mysqli_query($connections, "SELECT * FROM ssr_tracker WHERE dxc_ssr='$dxcssr';");
    $row2 = mysqli_fetch_assoc($query2);
    $description = $row2['description'];

    //email
    //$email = 'darce2@dxc.com';
    $email = 'jlazarte2@dxc.com';
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tmann7080@gmail.com';
    $mail->Password = 'pusa@1234';
    $mail->SMTPSecure = 'tsl';
    $mail->Port = 587;
    $mail->From = 'SSR Triage Team';
    $mail->FromName = 'DXC';
    $mail->addAddress($email);
    $mail->isHTML(true);

    if ($state != $old_state){
        if($query = mysqli_query($connections, "UPDATE ssr_snow SET state = '$state'
                WHERE sys_id='$sys_id'")){

                    //Insert NEW UPDATE Email Script here
                    $m1 = "Hello  Team, <br><br>";
                    $m2 = "This is to update the request <b>DXCSSR$dxcssr</b>.<br><br>";
                    $m3 = "The change no. in SNOW is " . "<b>$number</b>" . " is now in " . "<b>$state</b>" . " state. <br><br>";
                    $m4 = "Regards, <br> SSR Triage Team <br> DXC Technology";
                    $message = $m1.$m2.$m3.$m4;
                    $mail->Subject = $description;
                    $mail->Body = $message;

                    if(!$mail->send()){
                        echo 'Messaeg could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        echo 'Successful.';
                    }  
                }
    }
    else{
        //No new update
        
    }


?>