<?php
include ("./connections.php");

$ritm_no = $_GET['usydno'];
$number = $_GET['number'];

$query = mysqli_query($connections, "SELECT * FROM ssr_ritm ORDER BY ritm_no DESC LIMIT 1;");
$row = mysqli_fetch_assoc($query);

$ritm_no = $row['ritm_no'];
    $query = mysqli_query($connections, "UPDATE ssr_ritm SET usyd_change = '$number' WHERE ritm_no = '$ritm_no';");
    
    echo "<script>
                alert('New Request for Usyd has been made. $number has been created!');
                window.location.href='./normal.php';
                </script>"; 
?>