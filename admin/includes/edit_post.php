<?php

    if (isset($_GET['post_id'])) {
        $post_id_to_edit = $_GET['post_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = {$post_id_to_edit}";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $post_cat_id = $row['post_cat_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT post_image From posts WHERE post_id = {$post_id_to_edit}";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);

            while($row = mysqli_fetch_assoc($result)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_cat_id = '{$post_category_id}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_date = now() ";
        $query .= "WHERE post_id = {$post_id_to_edit} ";

        $result = mysqli_query($connection, $query);
        confirmQuery($result);

        echo "<div class='bg-success'><b>Post Edited Successfully. <a href='../post.php?post_id={$post_id_to_edit}'>(View Post)</a> <a href='./posts.php'>(Edit more posts)</a></b></div>";
    }

?>

<h1 class="page-header">
    Edit Post:
    <small>Author</small>
</h1>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo "$post_title" ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group" style="border: 2px solid #4b4b4b; border-radius: 5px;">
        <div style="margin: 10px 10px;">
            <label for="post_category_id">Post Category</label>
            <div>
                <?php

                    $query = "SELECT cat_title FROM categories WHERE cat_id = {$post_cat_id}";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_title = $row['cat_title'];
                        echo "The category of this post is <b>{$cat_title}</b>";
                    }

                ?>
            </div>
            <h5 style="font-weight: bold;">Change Category to:</h5>
            <select style="margin-top: 8px;" class="form-control" name="post_category_id">
                <?php

                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_id = $row['cat_id'];
                        $cat_title_new = $row['cat_title'];
                        $selected = $cat_title_new == $cat_title ? 'selected' : '';
                        echo "<option value='{$cat_id}' {$selected}>{$cat_title_new}</option>";
                    }

                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo "$post_author" ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group" style="border: 2px solid #4b4b4b; border-radius: 5px;">
        <div style="margin: 10px 10px;">
            <label for="post_image">Post Image</label>
            <div>
                <img style="margin-bottom: 8px; margin-top: 8px;" width="150px" src="../images/<?php echo "$post_image"; ?>" alt="">
            </div>
            <div>
                <h5 style="font-weight: bold;">Add A New Image</h5>
                <input type="file" value="<?php echo "$post_image"; ?>" class="btn" name="post_image">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo "$post_tags" ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"> <?php echo "$post_content" ?> </textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Post Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="draft" <?php if ($post_status == "draft") {echo "checked";} ?>>
            <label class="form-check-label" for="post_status">
                Draft
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="post_status" value="published" <?php if ($post_status == "published") {echo "checked";} ?>>
            <label class="form-check-label" for="post_status">
                Published
            </label>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>