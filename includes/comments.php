<!-- Blog Comments -->

                <?php 
                
                    if(isset($_POST['post_comment'])){
                        
                        //the post_id variable is coming from the single_post_page.php page and we are able to access this variable from here because the comments.php page is included in at the end of single_post_page.php page

                        $post_id = $_GET['post_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date) ";
                        $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', now())";

                        $result = mysqli_query($connection, $query);
                        
                        if(!$result){
                            die('QUERY FAILED') . mysqli_error($connection);
                        }
                        else{
                            echo '<script>setTimeout(function(){alert("Your comment has been submitted successfully, waiting for approval.")}, 500)</script>';
                        }

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query .= "WHERE post_id = $post_id ";

                        $result = mysqli_query($connection, $query);

                    }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input class="form-control" type="text" name="comment_author" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="comment_email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Give a comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="post_comment">Post Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                    $post_id = $_GET['post_id'];

                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die('QUERY FAILED') . mysqli_error($connection);
                    }

                    ?>

                        <h5>
                            <?php
                                $no_of_rows_returned = $result -> num_rows;
                                echo ($no_of_rows_returned > 1) ? "<b>$no_of_rows_returned</b> Comments" : "<b>$no_of_rows_returned</b> Comment";
                            ?>
                        </h5>
                        <hr>

                    <?php

                    while($row = mysqli_fetch_assoc($result)){
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                    
                ?>

                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php echo "$comment_author" ?>
                                    <small>
                                        <!-- August 25, 2014 at 9:30 PM -->
                                        <?php echo "- $comment_date" ?>
                                    </small>
                                </h4>
                                <?php echo "$comment_content" ?>
                            </div>
                        </div>

                <?php 
                    }
                ?>

                <!-- Comment -->

                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->

                        <!-- Nested Comment -->

                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->

                        <!-- End Nested Comment -->

                    <!-- </div>
                </div> -->