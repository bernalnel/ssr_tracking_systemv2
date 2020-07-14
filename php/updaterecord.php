<?php
    include ("./connections.php");

    $new_description = $_POST["subject"];
    $new_perform = $_POST["description"];
    $new_action = $_POST["action"];
    $new_dxc_ssr = $_POST["dxc_ssr"];

    $usyd_no = $_POST["usyd_no"];
    $new_priority = $_POST["priority"];
    $new_applicable = $_POST["applicable"];
    $new_sre_name = $_POST["sre_name"];
    $new_prior = $_POST["prior"];
    $new_ssr_owner = $_POST["ssr_owner"];
    $new_exec_date = $_POST["exec_date"];
    $new_start_time = $_POST["start_time"];
    $new_end_time = $_POST["end_time"];
    $new_usyd_cat = $_POST["usyd_cat"];
    //$new_description = $_POST["description"];



    mysqli_query($connections, "UPDATE ssr_tracker SET priority='$new_priority', applicable='$new_applicable', 
        sre_name='$new_sre_name', prior='$new_prior', ssr_owner='$new_ssr_owner', exec_date='$new_exec_date',
        start_time='$new_start_time', end_time='$new_end_time', usyd_cat='$new_usyd_cat', description='$new_description',
        perform='$new_perform', action_after='$new_action' 
        WHERE dxc_ssr='$usyd_no'");

    echo "<script language='javascript'>alert('Record has been updated!')</script>";
    echo "<script>window.location.href='../searchrequest.php';</script>";
    
    $email = 'arcedada@gmail.com';
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
    $message = "Hi, <br>Request has been updated for the <b>DXCSSR$new_dxc_ssr</b>";
    $mail->Subject = $description;
    $mail->Body = $message;

?>