<?php include "db_connect.php" ?>
<?php session_start(); ?>

<?php 

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['user_password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    
        while($row = mysqli_fetch_array($result)){
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            $db_user_status = $row['user_status'];
        }

        if($username === $db_username && $password === $db_user_password){

            if($db_user_status == "rejected"){
                echo "<h4>Your application has been rejected</h4>";
            }
            else if($db_user_status == "pending"){
                echo "<h4>Your application status is pending</h4>";
            }
            else{
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
                $_SESSION['user_role'] = $db_user_role;
                header("Location: ../admin/admin.php");
            }

        }
        else{
            header("Location: ../index.php");
        }
    }

?>