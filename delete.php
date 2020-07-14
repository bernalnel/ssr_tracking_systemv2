<?php

    $employee_id = $_REQUEST["employee_id"];

    include ("./php/connections.php");

    $query_delete = mysqli_query($connections, "SELECT * FROM ssr_accounts WHERE employee_id='$employee_id' ");

        while($row_delete = mysqli_fetch_assoc($query_delete)){
            $db_employee_id = $row_delete["employee_id"];
            $db_password = $row_delete["password"];
            $db_type = $row_delete["type"];
        }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    
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
                <h1 class="title">ATTENTION!</h1>
            </div>
        </div>
        <div class="p3-content">
            <p>Are you sure you want to delete <?php echo $employee_id; ?>? </p>
            <form method="POST" action="./php/confirmdelete.php">

                <input type="hidden" name="employee_id" value="<?php echo $db_employee_id; ?>" ><br><br>
            
                <input type="submit" value="Yes"> &nbsp;  <button type="submit" formaction="/modifyuser.php">No</button>
            
            </form>
        </div>
        <br>
    </div>

</body>
</html>