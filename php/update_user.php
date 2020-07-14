<?php
include ("connections.php");

$sql = "UPDATE ssr_accounts SET password='" . $_POST["password"] . "' ,type='" . $_POST["type"] . "' 
        WHERE employee_id='" . $_POST["user_id"] . "';";
if ($connections->query($sql) === TRUE) {
      echo "<script>
    alert('User has been updated!');
    window.location.href='../modifyuser.php';
    </script>";
}
else {
    echo "<script>
    alert('Error updating user');
    window.location.href='../modifyuser.php';
    </script>";
#echo "Error: " . $sql . "<br>" . $conn->error;
}
?> 