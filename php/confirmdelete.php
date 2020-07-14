<?php

    include ("./connections.php");

    $employee_id = $_POST["employee_id"];

    mysqli_query($connections, "DELETE FROM ssr_accounts WHERE employee_id='$employee_id'");

    echo "<script language='javascript'>alert('Record has been Deleted!')</script>";
    echo "<script>window.location.href='../modifyuser.php'; </script>";

?>