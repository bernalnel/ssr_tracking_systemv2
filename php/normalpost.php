<?php
include ("./connections.php");



$dxcssr = $_GET['dxcssr'];
$sys_id = $_GET['sys_id'];
$number = $_GET['number'];
$state = $_GET['state'];

$query = mysqli_query($connections, "SELECT * FROM ssr_tracker WHERE dxc_ssr='$dxcssr';");
            $row = mysqli_fetch_assoc($query);
            $description = $row['description'];

if($query = mysqli_query($connections, "INSERT INTO ssr_snow(dxc_ssr, sys_id, number, state) 
            VALUES ('$dxcssr','$sys_id','$number','$state')")){

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
            $m1 = "Hi, <br><br>";
            $m2 = "This is acknowledged. <br>";
            $m3 = "The DXC SSR No. for this request is <b>DXCSSR$dxcssr</b><br><br>";
            $m4 = "The change no. in SNOW is " . "<b>$number</b>" . " and in " . "<b>$state</b>" . " state.<br><br>";
            $m5 = "Regards, <br> SSR Triage Team <br> DXC Technology";
            $message = $m1.$m2.$m3.$m4.$m5;
            $mail->Subject = $description;
            $mail->Body = $message;

            if(!$mail->send()){
                echo 'Messaeg could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                echo 'Successful.';
            }  

                echo "<script>
                alert('New Request has been made. $number has been created!');
                window.location.href='../admin.html';
                </script>"; 
            }


                      
?>
