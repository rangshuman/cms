<?php

if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_status) ";
    $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}', 'pending') ";
    
    // var_dump($query);

    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    echo "<div class='bg-success'><b>User Created Successfully. " . "" . "<a href='./users.php'>(View all users)</a></b></div>";

    // var_dump($result);
}

?>



<h1 class="page-header">
    Add User:
    <!-- <small>Author</small> -->
</h1>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="post_title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="post_title">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <!-- <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select class="form-control" id="" name='post_category_id'> -->
            <?php 

                // $query = "SELECT * FROM categories";
                // $result = mysqli_query($connection, $query);
                // confirmQuery($result);

                // while($row = mysqli_fetch_assoc($result)){
                //     $cat_id = $row['cat_id'];
                //     $cat_title = $row['cat_title'];
                //     echo "<option value='{$cat_id}'>{$cat_title}</option>";
                // }
            
            ?>
        <!-- </select>
    </div> -->

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->

    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" class="btn" name="user_image">
    </div>

    <!-- <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Post Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="draft" checked>
            <label class="form-check-label" for="post_status">
                Draft
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="published">
            <label class="form-check-label" for="post_status">
                Published
            </label>
        </div>
    </div> -->

    <div class="form-group">
        <label for="post_category_id">User Role</label>
        <select class="form-control" id="" name='user_role'>
            <option value="author" selected>Author</option>
            <option value="speaker">Speaker</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>

</form>