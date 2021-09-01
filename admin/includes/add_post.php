<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";

    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $last_created_post_id = mysqli_insert_id($connection);
    //this above mysqli_insert_id() function gets the last created id from the database

    echo "<div class='bg-success'><b>Post Added Successfully. <a href='../post.php?post_id={$last_created_post_id}'>(View Post)</a> <a href='./posts.php'>(Edit more posts)</a></b></div>";
}

?>



<h1 class="page-header">
    Add Post:
    <small>Author</small>
</h1>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>


    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select class="form-control" id="" name='post_category_id'>
            <?php 

                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                confirmQuery($result);

                while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="btn" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
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
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>