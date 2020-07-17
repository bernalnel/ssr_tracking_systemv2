<?php
    include ("./php/connections.php");

    if (isset($_GET["search"])){
        $check = $_GET["search"];

        $terms = explode(" ", $check);
        $q = "SELECT * FROM ssr_accounts WHERE ";
        $i = 0;

    foreach($terms as $each){
            $i++;
            if($i==1){
                $q .= "employee_id LIKE '%$each%' ";
            }
            else{
                $q .= "OR employee_id LIKE '%$each%' ";
            }
        }

        $query = mysqli_query($connections, $q);
    }
    else{
        $check = "";
        $query = mysqli_query($connections, "SELECT * FROM ssr_accounts");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Modify User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/modifyuser.css">
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
                <h1 class="title">ADD/MODIFY USER</h1>
            </div>
        </div>
        <div class="p3-content">
            <div class="form">
                <form>
                    <form method="GET" action="modifyuser.php">
                        <label for="Sdxcssr_no">Search User ID</label>
                        <input type="text" id="Sdxcssr_no" name="search" value="<?php echo $check; ?>" required>
                        <input type="submit" value="search">
                    </form>
                    <br>
                    <form method="post" action="modifyuser.php">
                        <input type="submit" name="clear" value="Clear">
                        <button type="button" id="back" onclick="goBack()">back</button><br><br>
                    </form>
            
                    <br>
                    <div class="container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>User ID</th>
                                    <th>Password</th>
                                    <th>User Type</th>
                                    <th>User Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        $employee_id = $row["employee_id"];
                                        $password = $row["password"];
                                        $type = $row["type"];
                                        $user_email = $row["user_email"];
                                
                                        echo "<tr>
                                                <td><a href='delete.php?employee_id=$employee_id'>Delete</a></td>
                                                <td>$employee_id</td>
                                                <td>$password</td>
                                                <td>$type</td>
                                                <td>$user_email</td>
                                                
                                            </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><br>
                </form>
                <form method="post" autocomplete="off">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password">
                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type">
                    <label for="user_email">User Email:</label>
                    <input type="text" id="user_email" name="user_email"><br><br>
                    <button type="submit" id="create_user" id="create_user" formaction="./php/create_user.php">Create User</button>
                    <button type="submit" id="update" id="update" formaction="./php/update_user.php">Update</button><br>
                </form>
                <br>
                <button type="button" id="back" onclick="goBack()">back</button>
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
