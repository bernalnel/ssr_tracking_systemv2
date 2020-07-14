<html>

<head>
    <script src="./normalget.js"></script>
</head>



<?php
include ("./connections.php");




    $query = mysqli_query($connections, "SELECT * FROM ssr_snow;");
    //Select all request
    echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    while($row = mysqli_fetch_assoc($query)){
            $sys_id = $row["sys_id"];
        echo "<script type='text/javascript'>normalget('$sys_id')</script>";
    }
        echo "<script>alert('Tickets are now updated')</script>";
    header( "refresh:5; url=../searchrequest.php");
    
?>
</html>