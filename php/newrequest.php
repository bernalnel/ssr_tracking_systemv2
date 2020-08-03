<?php
    include ("./connections.php");
    include ("./usydpost.js");
    session_start();

    $requestor = $_SESSION['user_email'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["subject"]){
            $description = $_POST["subject"];
        }
        // if($_POST["usyd_no"]){
        //     $usyd_no = $_POST["usyd_no"];
        // }
        if($_POST["priority"]){
            $priority = $_POST["priority"];
        }
        if($_POST["applicable"]){
            $applicable = $_POST["applicable"];
        }
        if($_POST["sre_name"]){
            $sre_name = $_POST["sre_name"];
        }
        if($_POST["prior"]){
            $prior = $_POST["prior"];
        }
        if($_POST["action"]){
            $action_after = $_POST["action"];
        }
        if($_POST["ssr_owner"]){
            $ssr_owner = $_POST["ssr_owner"];
        }
        if($_POST["exec_date"]){
            $exec_date = $_POST["exec_date"];
        }
        if($_POST["start_time"]){
            $start_time = $_POST["start_time"];
        }
        if($_POST["end_time"]){
            $end_time = $_POST["end_time"];
        }
        if($_POST["usyd_cat"]){
            $usyd_cat = $_POST["usyd_cat"];
            $dxc_cat = $usyd_cat;
        }
        if($_POST["description"]){
            $perform = $_POST["description"];
        }
        if($_POST["classification"]){
            $classification = $_POST["classification"];
        }

        //date & time in a different time zone e.g. Australia/sydney
        //date_default_timezone_set('Australia/Sydney');
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        //status of request
        $status = '';

        //dxc_contact - PDLs
        if($usyd_cat === "asa"){
            $dxc_contact = "cyber_nss_unisyd@dxc.com";
        }
        if($usyd_cat === "backup"){
            $dxc_contact = "itogdcgocphbursusyd@dxc.com";
        }
        if($usyd_cat === "oracle"){
            $dxc_contact = "redrocksupport@dxc.com";
        }
        if($usyd_cat === "sql"){
            $dxc_contact = "rocksolid.sqlsupport@dxc.com";
        }
        if($usyd_cat === "f5"){
            $dxc_contact = "sim@dxc.com";
        }
        if($usyd_cat === "msv"){
            $dxc_contact = "anz-ph-cloudops-uos@dxc.com";
        }
        if($usyd_cat === "nsx"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }
        if($usyd_cat === "aws"){
            $dxc_contact = "dxc_in_aws_cloudops_pod1@dxc.com";
        }
        if($usyd_cat === "azure"){
            $dxc_contact = "dxc_in_azure_cloudops_pod2@dxc.com";
        }
        if($usyd_cat === "storage"){
            $dxc_contact = "itogdcgocphbursusyd@dxc.com";
        }
        if($usyd_cat === "unix"){
            $dxc_contact = "BSS_ITO_GOC_PH_UNIX_USYD@dxc.com";
        }
        if($usyd_cat === "vmware"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }
        if($usyd_cat === "wintel"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }


        if($query = mysqli_query($connections, "INSERT INTO ssr_ritm(ritm_no, subject, priority, applicable, sre_name, prior, action_after, ssr_owner, exec_date, start_time, end_time, usyd_cat, usyd_change)
            VALUES ('','$description','$priority','$applicable','$sre_name','$prior','$action_after','$ssr_owner','$exec_date','$start_time','$end_time','$usyd_cat','')")){


            $retrieve_query = mysqli_query($connections, "SELECT * FROM ssr_ritm ORDER BY ritm_no DESC LIMIT 1");
            while($roww = mysqli_fetch_assoc($retrieve_query)){
                $db_ritm = $roww["ritm_no"];

                $query = mysqli_query($connections, "INSERT INTO ssr_tracker(description, usyd_no, priority, applicable, sre_name, prior, action_after, ssr_owner, exec_date, start_time, end_time, usyd_cat, dxc_cat, perform, date, status, dxc_contact, client_mail, classification)
            VALUES ('$description','$db_ritm','$priority','$applicable','$sre_name','$prior','$action_after','$ssr_owner','$exec_date','$start_time','$end_time','$usyd_cat','$dxc_cat','$perform', '$date', '$status', '$dxc_contact', '$requestor', '$classification')");
            }

                            //IMPORTANT CHANGE THE FOLDER OF USYD_NO TO DXCSSR
                // Uploads files

                // Create Folder
                $query = mysqli_query($connections, "SELECT * FROM ssr_tracker ORDER BY dxc_ssr DESC LIMIT 1;");
                $row = mysqli_fetch_assoc($query);

                $dxc_ssr = $row['dxc_ssr'];

                echo "Check file if not empty";

                if (isset($_FILES['myfile'])) {
                echo "File is not empty";
                if (!file_exists('../uploads/' . $row['dxc_ssr'])) {
                    mkdir('../uploads/' . $row['dxc_ssr'], 0777, true);
                }

                $i = 0;
                foreach ($_FILES['myfile']['name'] as $filename){
                    $destination = '../uploads/' . $row['dxc_ssr'] . '/' . $filename;
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    //temp
                    $file = $_FILES['myfile']['tmp_name'][$i];
                    $size = $_FILES['myfile']['size'][$i];
                    //size
                    if ($_FILES['myfile']['size'][$i] > 10000000) {
                        echo "File too large!";
                    }
                    else {
                    //temp to dest
                            if (move_uploaded_file($file, $destination)) {
                                    echo "File uploading";
                            $sql = "INSERT INTO ssr_files (dxc_ssr, name, size, downloads) VALUES ('".$row['dxc_ssr']."','$filename', $size, 0)";
                            if (mysqli_query($connections, $sql)) {
                            }
                        }
                        else {
                            echo "Failed to upload file.";
                        }
                    }
                    $i++;
                }
            }

        }

       //SNOW CREATION

       $category = "Software";
       $risk = $priority;
       $_SESSION['dxcsdescription'] = "DXCSSR" . $dxc_ssr . " - RITM" . $db_ritm . " - " . $description;
       $_SESSION['usydsdescription'] = "RITM" . $db_ritm . " - " . $description;
       $time = "2020-06-14 06:22:29";
       $start_time = $exec_date . " " . $start_time;
       $end_time = $exec_date . " " . $end_time;
       $_SESSION['dxcssr'] = $dxc_ssr;
       $_SESSION['ritm'] = $db_ritm;
       $_SESSION['category'] = $category;
       $_SESSION['priority'] = $priority;
       $_SESSION['risk'] = $risk;
       $_SESSION['start_time'] = $start_time;
       $_SESSION['end_time'] = $end_time;
       $_SESSION['classification'] = $classification;
       //header("Location: ../newrequest.html");
       header("Location: ./usyd.php");

    }
?>
