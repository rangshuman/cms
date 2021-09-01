<?php 

    if(isset($_GET['delete_comment'])){
        $comment_id_to_delete = $_GET['delete_comment'];
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: comments.php");
    }

    if(isset($_GET['approve_comment'])){
        $comment_id_to_approve = $_GET['approve_comment'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id_to_approve}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: comments.php");
    }

    if(isset($_GET['unapprove_comment'])){
        $comment_id_to_unapprove = $_GET['unapprove_comment'];
        $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = {$comment_id_to_unapprove}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: comments.php");
    }

?>

<h1 class="page-header">
    Comments Control
    <!-- <small>Author</small> -->
</h1>

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Comment ID</th>
                                    <th>In Response to</th>
                                    <th>Comment Author</th>
                                    <th>Email</th>
                                    <th>Comment Content</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                
                                    $query = "SELECT * FROM comments";
                                    // $query .= "ORDER BY comment_id DESC";
                                    $result = mysqli_query($connection, $query);
                                    confirmQuery($result);
            
                                    while($row = mysqli_fetch_assoc($result)){
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_email = $row['comment_email'];
                                        $comment_content = $row['comment_content'];
                                        $comment_date = $row['comment_date'];
                                        $comment_status = $row['comment_status'];

                                        echo "<tr>";
                                        echo "<td>{$comment_id}</td>";

                                        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                                        $get_post_title = mysqli_query($connection, $query);
                                        confirmQuery($get_post_title);
                
                                        while($row = mysqli_fetch_assoc($get_post_title)){
                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                            echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
                                        }

                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_content}</td>";
                                        echo "<td>{$comment_date}</td>";
                                        echo "<td>{$comment_status}</td>";

                                        echo "<td><a href='comments.php?approve_comment={$comment_id}'>Approve Comment</a></td>";
                                        echo "<td><a href='comments.php?unapprove_comment={$comment_id}'>Unapprove Comment</a></td>";
                                        echo "<td><a href='comments.php?delete_comment={$comment_id}'>Delete Comment</a></td>";
                                        echo "</tr>";
                                    }
                                    
                                ?>

                            </tbody>
                        </table>