<?php
    include ("./php/connections.php");
    if (isset($_GET["search"])){
            $check = $_GET["search"];

            $terms = explode(" ", $check);
            $q = "SELECT * FROM ssr_tracker WHERE ";
            $i = 0;

        foreach($terms as $each){
                $i++;
                if($i==1){
                    $q .= "usyd_no LIKE '%$each%' ";
                }
                else{
                    $q .= "OR usyd_no LIKE '%$each%' ";
                }
            }

            $query = mysqli_query($connections, $q);
        }
        else{
            $check = "";
            // $query = mysqli_query($connections, "SELECT * FROM ssr_tracker");
            //$query = mysqli_query($connections, "SELECT ssr_tracker.date, ssr_tracker.dxc_ssr, ssr_tracker.dxc_ssr, ssr_tracker.usyd_no, ssr_tracker.ssr_owner, ssr_tracker.sre_name, ssr_tracker.change_created, ssr_tracker.prior, ssr_tracker.usyd_cat, 
            //                                    ssr_tracker.dxc_cat, ssr_tracker.dxc_contact, ssr_tracker.priority, ssr_tracker.dateof_exec, ssr_tracker.dateof_completion, ssr_tracker.age, ssr_tracker.remarks, ssr_tracker.description, ssr_tracker.status, 
            //                                    ssr_snow.state, ssr_snow.change_number
            //                                    FROM ssr_tracker
            //                                    JOIN ssr_snow ON ssr_tracker.dxc_ssr=ssr_snow.dxc_ssr
            //                                    ORDER BY ssr_tracker.dxc_ssr");
            $query = mysqli_query($connections, "SELECT * FROM ssr_tracker;");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Request</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/contentwithtable.css">
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
                <h1 class="title">SEARCH REQUEST</h1>
            </div>
        </div>
        <div class="p3-content">
            <div class="form">
                <form>
                    <form method="GET" action="searchrequest.php">
                        <label for="Sdxcssr_no">Search RITM No.</label>
                        <input type="text" id="Sdxcssr_no" name="search" value="<?php echo $check; ?>" required>
                        <input type="submit" value="search">
                        <button type="button" id="back" onclick="goBack()">Back</button>
                        <input type="submit" name="clear" value="Clear">
                    </form>
                    <form method="post" action="searchrequest.php">
                       
                    </form>
                    <div class="table-scroll">
                        <table class="main-table">
                            <thead>
                                <tr>
                                    <th>Open Request</th>
                                    <th>Date Received</th>
                                    <th>DXC SSR No</th>
                                    <th>Usyd No</th>
                                    <th>SSR Owner</th>
                                    <th>SRE Name</th>
                                    <th>Status</th>
                                    <th>Change Number</th>
                                    <th>USYD Change Number</th>
                                    <th>State</th>
                                    <th>Prior to this SSR</th>
                                    <th>Usyd Category</th>
                                    <th>DXC Category</th>
                                    <th>DXC SSR Contact</th>
                                    <th>Priority</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            <?php
                            while($row = mysqli_fetch_assoc($query)){
                                $db_date = $row["date"];
                                $db_dxc_ssr = $row["dxc_ssr"];
                                $db_usyd_no = $row["usyd_no"];
                                $db_ssr_owner = $row["ssr_owner"];
                                $db_sre_name = $row["sre_name"];
                                $db_status = $row["status"];
                                //$db_state = $row["state"];
                                $db_change_no = $row["change_no"];
                                //$db_change_no = $row["change_number"];
                                $db_change_created = $row["change_created"];
                                $db_prior = $row["prior"];
                                $db_usyd_cat = $row["usyd_cat"];
                                $db_dxc_cat = $row["dxc_cat"];
                                $db_dxc_contact = $row["dxc_contact"];
                                $db_priority = $row["priority"];
                                $db_dateof_exec = $row["dateof_exec"];
                                $db_dateof_completion = $row["dateof_completion"];
                                $db_age = $row["age"];
                                $db_remarks = $row["remarks"];
                                $db_description = $row["description"];

                                $query2 = mysqli_query($connections, "SELECT * FROM ssr_snow WHERE dxc_ssr=$db_dxc_ssr;");
                                if (mysqli_num_rows($query2)!=0){
                                $row2 = mysqli_fetch_assoc($query2);
                                $db_state = $row2["state"];
                                $db_change_no = $row2["number"];
                                }
                                else{
                                    $db_state = "";
                                    $db_change_no = "";
                                }
				$query2 = mysqli_query($connections, "SELECT * FROM ssr_ritm WHERE ritm_no=$db_usyd_no;");
				 if ($query2){
				$row2 = mysqli_fetch_assoc($query2);
                                $usyd_change = $row2["usyd_change"];
                                }
                                else{
                                    $usyd_change = "";
                                }
                                    echo "<tr>
                                        <th><a href='openrequest.php?dxcssr=$db_dxc_ssr'>Open</a></th>
                                        <th>$db_date</th>
                                        <th>DXCSSR$db_dxc_ssr</th>
                                        <th>RITM$db_usyd_no</th>
                                        <th>$db_ssr_owner</th>
                                        <th>$db_sre_name</th>
                                        <th>$db_status</th>
                                        <th>$db_change_no</th>
                                        <th>$usyd_change</th>
                                        <th>$db_state</th>
                                        <th>$db_prior</th>
                                        <th>$db_usyd_cat</th>
                                        <th>$db_dxc_cat</th>
                                        <th>$db_dxc_contact</th>
                                        <th>$db_priority</th>
                                        <th>$db_description</th>
                                        </tr>";
                                }
                            ?>
                            
                            </tbody>
                        </table>
                    </div><br>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    function goBack() {
        history.back();
    }
</script>

</html>
