<?php
include ("./connections.php");
session_start();

$check_employee = mysqli_query($connections, "SELECT * FROM ssr_accounts WHERE employee_id= '" . $_POST["user"] . "';");
$check_employee_row = mysqli_num_rows($check_employee);

if($check_employee_row > 0){
    while($row = mysqli_fetch_assoc($check_employee)){
        $db_password = $row["password"];
        $db_type = $row["type"];
        $db_email = $row["user_email"];

        $_SESSION['user_email'] = $db_email;
        
            if($_POST["password"] == $db_password){
                if($db_type == "admin"){
                    echo "<script>
                window.location.href='../admin.html';
                </script>";
                }
                else{
                    echo "<script>
                    window.location.href='../customer.html';
                    </script>"; 
                }
            }
    }
}
else{
    echo "<script>
    alert('Incorrect Username/Password!');
    window.location.href='../index.html';
    </script>";
}
?>