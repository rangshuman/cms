<?php 

    if(isset($_GET['delete_post'])){
        $post_id_to_delete = $_GET['delete_post'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
    }

?>

<h1 class="page-header">
    All Posts by:
    <small>Author</small>
</h1>

<?php
    if(isset($_POST['checkBoxArray'])){
        $post_ids_array = $_POST['checkBoxArray'];
        foreach($post_ids_array as $post_id){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_id}";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_id}";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">

                                <div id="bulkOptionsContainer" class='col-xs-4'>
                                    <select class="form-control" name="bulk_options" id="">
                                        <option value="">Select Options</option>
                                        <option value="published">Publish</option>
                                        <option value="draft">Draft</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                    <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
                                </div>

                                <div id="margin"></div>

                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" type="checkbox"></th>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Post Title</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    
                                        $query = "SELECT * FROM posts";
                                        $result = mysqli_query($connection, $query);
                                        confirmQuery($result);
                
                                        while($row = mysqli_fetch_assoc($result)){
                                            $post_id = $row['post_id'];
                                            $post_cat_id = $row['post_cat_id'];
                                            $post_title = $row['post_title'];
                                            $post_author = $row['post_author'];
                                            $post_date = $row['post_date'];
                                            $post_image = $row['post_image'];
                                            //$post_content = $row['post_content'];
                                            $post_tags = $row['post_tags'];
                                            $post_comment_count = $row['post_comment_count'];
                                            $post_status = $row['post_status'];

                                            echo "<tr>";
                                    ?>

                                            <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo "{$post_id}"; ?>"></td>
                                    
                                    <?php
                                            echo "<td>{$post_id}</td>";
                                            echo "<td>{$post_author}</td>";
                                            echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";

                                            $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
                                            $get_categories = mysqli_query($connection, $query);
                                            confirmQuery($get_categories);
                    
                                            while($row = mysqli_fetch_assoc($get_categories)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                                echo "<td>{$cat_title}</td>";
                                            }

                                            echo "<td><img class='img-responsive' width='150px' src='../images/{$post_image}'></td>";
                                            echo "<td>{$post_tags}</td>";
                                            echo "<td>{$post_comment_count}</td>";
                                            echo "<td>{$post_date}</td>";
                                            echo "<td>{$post_status}</td>";
                                            echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit Post</a></td>";
                                            echo "<td><a href='posts.php?delete_post={$post_id}'>Delete Post</a></td>";
                                            echo "</tr>";
                                        }
                                        
                                    ?>

                                </tbody>
                            </table>
</form>