<?php
session_start();

$category = $_SESSION['category'];
$priority = $_SESSION['priority'];
$risk = $_SESSION['risk'];
$sdescription = $_SESSION['usydsdescription'];
$start_time = $_SESSION['start_time'];
$end_time = $_SESSION['end_time'];
$ritm_no = $_SESSION['ritm'];

?>
<script src='./usydpost.js'></script>
<html>

<head>
<script src='./usydpost.js'></script>
</head>

<body onload="usydpost('<?php echo $category ?>',
    '<?php echo $priority ?>', '<?php echo $category ?>', '<?php echo $sdescription ?>',
    '<?php echo $start_time ?>', '<?php echo $end_time ?>', '<?php echo $ritm_no ?>')">

</body>

</html>
