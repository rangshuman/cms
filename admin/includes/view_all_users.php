<?php 

    if(isset($_GET['delete_user'])){
        $user_id_to_delete = $_GET['delete_user'];
        $query = "DELETE FROM users WHERE user_id = {$user_id_to_delete}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: users.php");
    }

    if(isset($_GET['approve_user'])){
        $user_id_to_approve = $_GET['approve_user'];
        $query = "UPDATE users SET user_status = 'approved' WHERE user_id = {$user_id_to_approve}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: users.php");
    }

    if(isset($_GET['unapprove_user'])){
        $user_id_to_unapprove = $_GET['unapprove_user'];
        $query = "UPDATE users SET user_status = 'rejected' WHERE user_id = {$user_id_to_unapprove}";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        header("Location: users.php");
    }

?>

<h1 class="page-header">
    User Control
    <!-- <small>Author</small> -->
</h1>

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>User Image</th>
                                    <th>Role</th>
                                    <th>Application Status</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                
                                    $query = "SELECT * FROM users";
                                    // $query .= "ORDER BY comment_id DESC";
                                    $result = mysqli_query($connection, $query);
                                    confirmQuery($result);
            
                                    while($row = mysqli_fetch_assoc($result)){
                                        $user_id = $row['user_id'];
                                        $username = $row['username'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_image = $row['user_image'];
                                        $user_role = $row['user_role'];
                                        $user_status = $row['user_status'];

                                        echo "<tr>";
                                        echo "<td>{$user_id}</td>";
                                        echo "<td>{$username}</td>";

                                        // $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                                        // $get_post_title = mysqli_query($connection, $query);
                                        // confirmQuery($get_post_title);
                
                                        // while($row = mysqli_fetch_assoc($get_post_title)){
                                        //     $post_id = $row['post_id'];
                                        //     $post_title = $row['post_title'];
                                        //     echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
                                        // }

                                        echo "<td>{$user_firstname}</td>";
                                        echo "<td>{$user_lastname}</td>";
                                        echo "<td>{$user_email}</td>";
                                        echo "<td><img width='150px' src='../images/{$user_image}' alt=''></td>";
                                        echo "<td>{$user_role}</td>";
                                        echo "<td>{$user_status}</td>";
                                        // echo "<td>{$comment_status}</td>";

                                        echo "<td><a href='users.php?approve_user={$user_id}'>Approve User</a></td>";
                                        echo "<td><a href='users.php?unapprove_user={$user_id}'>Unapprove User</a></td>";
                                        echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit User</a></td>";
                                        echo "<td><a href='users.php?delete_user={$user_id}'>Remove User</a></td>";
                                        echo "</tr>";
                                    }
                                    
                                ?>

                            </tbody>
                        </table>