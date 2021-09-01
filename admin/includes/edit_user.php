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

        echo '<script>setTimeout(function(){alert("Info Updated Successfully")}, 500)</script>';
        
        // header("Location: users.php?source=edit_user&user_id={$user_id_to_edit}");
        // echo '<script>alert("Info Updated Successfully")</script>';
    }

?>

<h1 class="page-header">
    Edit User Info. :
    <!-- <small>Author</small> -->
</h1>

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

    <!-- <div class="form-group" style="border: 2px solid #4b4b4b; border-radius: 5px;">
        <div style="margin: 10px 10px;">
            <label for="post_category_id">Post Category</label>
            <div> -->
                <?php

                    // $query = "SELECT cat_title FROM categories WHERE cat_id = {$post_cat_id}";
                    // $result = mysqli_query($connection, $query);
                    // confirmQuery($result);

                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     $cat_title = $row['cat_title'];
                    //     echo "The category of this post is <b>{$cat_title}</b>";
                    // }

                ?>
            <!-- </div>
            <h5 style="font-weight: bold;">Change Category to:</h5>
            <select style="margin-top: 8px;" class="form-control" name="post_category_id"> -->
                <?php

                    // $query = "SELECT * FROM categories";
                    // $result = mysqli_query($connection, $query);
                    // confirmQuery($result);

                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     $cat_id = $row['cat_id'];
                    //     $cat_title_new = $row['cat_title'];
                    //     $selected = $cat_title_new == $cat_title ? 'selected' : '';
                    //     echo "<option value='{$cat_id}' {$selected}>{$cat_title_new}</option>";
                    // }

                ?>
            <!-- </select>
        </div>
    </div> -->

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php  ?>" type="text" class="form-control" name="post_author"> -->
    <!-- </div> -->

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

    <!-- <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"> <?php  ?> </textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Post Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="draft" <?php  ?>>
            <label class="form-check-label" for="post_status">
                Draft
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="published" <?php  ?>>
            <label class="form-check-label" for="post_status">
                Published
            </label>
        </div>
    </div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user_info" value="Update Info">
    </div>

</form>