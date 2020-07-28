<?php
// connect to the database
include ("./connections.php");

$id = $_GET['file_id'];

$sql = "SELECT * FROM ssr_files WHERE dxc_ssr='$id'";
$result = mysqli_query($connections, $sql);

$i = 1;
while($row = mysqli_fetch_assoc($result)){
    if($i == $_GET['i']){
        $name = $row['name'];


        $filepath = '../uploads/' . $id . '/' . $name;

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('../uploads/' . $id . '/' . $name));
            readfile('../uploads/' . $id . '/' . $name);
        }
    }
    $i = $i + 1;
}

?>