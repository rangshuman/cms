<!-- header -->
<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Update Profile
                        <!-- <small>Author</small> -->
                        <small>
                            (You can make changes to your profile here)
                        </small>
                    </h1>

                    <?php

                        if (isset($_GET['user_id'])) {
                            $user_id_to_edit = $_GET['user_id'];
                        }

                        $query = "SELECT * FROM users WHERE user_id = {$user_id_to_edit}";
                        $result = mysqli_query($connection, $query);
                        confirmQuery($result);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_role = $row['user_role'];
                        }

                        if(isset($_POST['update_user_info'])){
                            $username = $_POST['username'];
                            $user_firstname = $_POST['user_firstname'];
                            $user_lastname = $_POST['user_lastname'];
                            $user_email = $_POST['user_email'];
                            $user_role = $_POST['user_role'];

                            $user_image = $_FILES['user_image']['name'];
                            $user_image_temp = $_FILES['user_image']['tmp_name'];

                            move_uploaded_file($user_image_temp, "../images/$user_image");

                            if(empty($user_image)){
                                $query = "SELECT user_image FROM users WHERE user_id = {$user_id_to_edit}";
                                $result = mysqli_query($connection, $query);
                                confirmQuery($result);

                                while($row = mysqli_fetch_assoc($result)){
                                    $user_image = $row['user_image'];
                                }
                            }

                            $query = "UPDATE users SET ";
                            $query .= "username = '{$username}', ";
                            $query .= "user_firstname = '{$user_firstname}', ";
                            $query .= "user_lastname = '{$user_lastname}', ";
                            $query .= "user_email = '{$user_email}', ";
                            $query .= "user_image = '{$user_image}', ";
                            $query .= "user_role = '{$user_role}' ";
                            $query .= "WHERE user_id = {$user_id_to_edit} ";

                            $result = mysqli_query($connection, $query);
                            confirmQuery($result);

                            $query = "SELECT * FROM users WHERE user_id = {$user_id_to_edit}";
                            $result = mysqli_query($connection, $query);
                            confirmQuery($result);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_role = $row['user_role'];
                                $_SESSION['user_role'] = $user_role;
                            }

                            echo '<script>setTimeout(function(){alert("Info Updated Successfully")}, 500)</script>';
                            
                            // header("Location: users.php?source=edit_user&user_id={$user_id_to_edit}");
                            // echo '<script>alert("Info Updated Successfully")</script>';
                        }

                    ?>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="post_title">Username</label>
                            <input value="<?php echo "$username" ?>" type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="post_title">First Name</label>
                            <input value="<?php echo "$user_firstname" ?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_title">Last Name</label>
                            <input value="<?php echo "$user_lastname" ?>" type="text" class="form-control" name="user_lastname">
                        </div>

                        <div class="form-group">
                            <label for="post_title">User Email</label>
                            <input value="<?php echo "$user_email" ?>" type="text" class="form-control" name="user_email">
                        </div>

                        <div class="form-group" style="border: 2px solid #4b4b4b; border-radius: 5px;">
                            <div style="margin: 10px 10px;">
                                <label for="post_image">Update Image</label>
                                <div>
                                    <img style="margin-bottom: 8px; margin-top: 8px;" width="150px" src="../images/<?php echo "$user_image"; ?>" alt="">
                                </div>
                                <div>
                                    <h5 style="font-weight: bold;">Add A New Image</h5>
                                    <input type="file" value="<?php echo "$user_image"; ?>" class="btn" name="user_image">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="post_tags">Role</label>
                            <input value="<?php echo "$user_role" ?>" type="text" class="form-control" name="user_role">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user_info" value="Update Profile">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>