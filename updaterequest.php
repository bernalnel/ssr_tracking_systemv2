<?php

    $dxc_ssr = $_REQUEST["dxcssr"];

    include ("./php/connections.php");

    $get_record = mysqli_query($connections, "SELECT * FROM ssr_tracker WHERE dxc_ssr='$dxc_ssr'");

    while($row = mysqli_fetch_assoc($get_record)){
        $db_subject = $row["description"];
        $db_action = $row["action_after"];
        $db_perform = $row["perform"];

        $db_usyd_no = $row["usyd_no"];
        $db_priority = $row["priority"];
        $db_applicable = $row["applicable"];
        $db_sre_name = $row["sre_name"];
        $db_prior = $row["prior"];
        $db_ssr_owner = $row["ssr_owner"];
        $db_exec_date = $row["exec_date"];
        $db_start_time = $row["start_time"];
        $db_end_time = $row["end_time"];
        $db_usyd_cat = $row["usyd_cat"];
        $db_description = $row["description"];
        $db_perform = $row["perform"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Request</title>
    
    <link rel="stylesheet" href="css/content.css">
</head>

<body>

    <div class="full-height">
        <div class="p1-colorstrip">
        </div>
        <div class="p2">
            <div class="logodiv">
                <img class="logo1" src="images/logo1.png" alt="Usyd logo">
            </div>
            <div class="titlediv">
                <h1 class="title">UPDATE REQUEST</h1>
            </div>
        </div>
        <div class="p3-content">
            <form method="POST" action="./php/updaterecord.php" enctype="multipart/form-data">
                <h2>SSR Request Details</h2>
                <label for="subject">Import a file:</label>
                <input class="center-block" type="file" name="myfile"><br>
            
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?php echo $db_subject; ?>"><br>
            
                <label for="usyd_no">Usyd Service request reference:</label>
                <input type="text" id="usyd_no" name="usyd_no" value="<?php echo $db_usyd_no; ?>" required><br>

                <label for="dxc_ssr">DXC SSR:</label>
                <input type="text" id="dxc_ssr" name="dxc_ssr" value="<?php echo $dxc_ssr; ?>" required><br>
            
                <label for="priority">Usyd Priority:</label>
                <select id="priority" name="priority" value="<?php echo $db_priority; ?>">
                    <option value="p1" <?php if($db_priority=='p1'){echo "selected";} ?> >P1 - Critical</option>
                    <option value="p2" <?php if($db_priority=='p2'){echo "selected";} ?> >P2 - High</option>
                    <option value="p3" <?php if($db_priority=='p3'){echo "selected";} ?> >P3 - Moderate</option>
                    <option value="p4" <?php if($db_priority=='p4'){echo "selected";} ?> >P4 - Low</option>
                </select><br><br>
            
                <b><label for="sequencing">Usyd Sequencing:</label></b><br>
                <label for="applicable">Applicable (yes/no):</label>
                <select id="applicable" name="applicable" value="<?php echo $db_applicable; ?>">
                    <option value="yes" <?php if($db_applicable=='yes'){echo "selected";} ?> >Yes</option>
                    <option value="no" <?php if($db_applicable=='no'){echo "selected";} ?> >No</option>
                </select><br>
            
                <label for="sre_name">Usyd Person responsible to coordinate:</label>
                <input type="text" id="sre_name" name="sre_name" value="<?php echo $db_sre_name; ?>" required><br>
            
                <label for="prior">Actions to be done prior to this SSR:</label>
                <input type="text" id="prior" name="prior" value="<?php echo $db_prior; ?>" ><br>
            
                <label for="action">Actions to be done after this SSR:</label>
                <input type="text" id="action" name="action" value="<?php echo $db_action; ?>"><br><br>
            
                <label for="ssr_owner">Service Request Owner:</label>
                <input type="text" id="ssr_owner" name="ssr_owner" value="<?php echo $db_ssr_owner; ?>" required><br><br>
            
                <b><label for="exe">Execution Window:</label></b><br>
                <label for="exec_date">Date:</label>
                <input type="date" id="exec_date" name="exec_date" value="<?php echo $db_exec_date; ?>" required><br>
            
                <label for="start_time">Start time (24hr Time):</label>
                <input type="time" id="start_time" name="start_time" value="<?php echo $db_start_time; ?>" required><br>
            
                <label for="end_time">End time (24hr Time):</label>
                <input type="time" id="end_time" name="end_time" value="<?php echo $db_end_time; ?>" required><br>
            
                <label for="usyd_cat">Service Request Category: (Select the applicable category)</label>
                <select id="usyd_cat" name="usyd_cat" value="<?php echo $db_usyd_cat; ?>">
                    <option value="asa" <?php if($db_usyd_cat=='asa'){echo "selected";} ?> >ASA Firewall</option>
                    <option value="backup" <?php if($db_usyd_cat=='backup'){echo "selected";} ?> >Backup</option>
                    <option value="oracle" <?php if($db_usyd_cat=='oracle'){echo "selected";} ?> >Database Oracle</option>
                    <option value="sql" <?php if($db_usyd_cat=='sql'){echo "selected";} ?> >Database SQL</option>
                    <option value="f5" <?php if($db_usyd_cat=='f5'){echo "selected";} ?> >F5</option>
                    <option value="msv" <?php if($db_usyd_cat=='msv'){echo "selected";} ?> >MSV CloudOps</option>
                    <option value="nsx" <?php if($db_usyd_cat=='nsx'){echo "selected";} ?> >NSX Firewall</option>
                    <option value="aws" <?php if($db_usyd_cat=='aws'){echo "selected";} ?> >Public Aws CloudOps</option>
                    <option value="azure" <?php if($db_usyd_cat=='azure'){echo "selected";} ?> >Public Azure CloudOps</option>
                    <option value="storage" <?php if($db_usyd_cat=='storage'){echo "selected";} ?> >Storage Team</option>
                    <option value="unix" <?php if($db_usyd_cat=='unix'){echo "selected";} ?> >Unix/Linux</option>
                    <option value="vmware" <?php if($db_usyd_cat=='vmware'){echo "selected";} ?> >VMWare</option>
                    <option value="wintel" <?php if($db_usyd_cat=='wintel'){echo "selected";} ?> >Wintel</option>
                </select><br><br>
            
                <b><label for="perform">Please perform the following steps on</label></b><br>
            
                <b><label for="description">Description:</label></b><br>
                <textarea id="description" name="description" rows="30" cols="100"><?php echo $db_perform; ?></textarea required><br><br>
                
                <button type="submit" id="update_request">Update Request</button><br>
            </form>
        </div>
        <br>
    </div>

</body>
<script>
    function goBack() {
        history.back();
    }
</script>

</html>