<?php
include ("connections.php");

  $sql = "INSERT INTO ssr_accounts
  VALUES ('" . $_POST["user_id"] . "', '" . $_POST["password"] . "', '" . $_POST["type"] . "', '" . $_POST["user_email"] . "');";
  if ($connections->query($sql) === TRUE) {
      echo "<script>
    alert('New user created successfully!');
    window.location.href='../modifyuser.php';
    </script>";
  } 
  else {
      echo "<script>
    alert('Error creating user');
    window.location.href='../modifyuser.php';
    </script>";
    #echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?> 