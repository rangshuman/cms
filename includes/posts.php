<div class="container">

        <div class="row">

            <!-- blog entries column -->
            <div class="col-md-8">

                <?php 

                    if(isset($_GET['cat_id'])){
                        $cat_id = $_GET['cat_id'];
                
                            $query = "SELECT * FROM posts WHERE post_cat_id = {$cat_id}";
                            $result = mysqli_query($connection, $query);
                            $no_of_rows_returned = $result -> num_rows;

                            if($no_of_rows_returned == 0){

                                $query = "SELECT cat_title FROM categories WHERE cat_id = {$cat_id}"; 
                                $get_categories = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($get_categories)){
                                    $cat_title = $row['cat_title'];
                                }
                                echo "<h1 class='page-header'>";
                                echo "$cat_title";
                                echo "<small> (No posts found)</small>";
                                echo "</h1>";

                            }
                            else{

                                ?>
                                    <h1 class="page-header">
                                        <?php 
                                            $query = "SELECT cat_title FROM categories WHERE cat_id = {$cat_id}"; 
                                            $get_categories = mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($get_categories)){
                                                $cat_title = $row['cat_title'];
                                            }
                                            echo "$cat_title";
                                        ?>
                                        <small><?php echo ($no_of_rows_returned > 1) ? "($no_of_rows_returned posts)" : "($no_of_rows_returned post)" ?></small>
                                    </h1>

                                <?php

                                while($row = mysqli_fetch_assoc($result)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_date = $row['post_date'];
                                    $post_image = $row['post_image'];
                                    $post_content = substr($row['post_content'], 0, 300);
                                    
                            ?>

                                    <!-- First Blog Post -->
                                    <h2>
                                        <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                                    </h2>
                                    <p class="lead">
                                        by <a href="#"><?php echo $post_author ?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                                    <hr>
                                    <a href="post.php?post_id=<?php echo $post_id ?>">
                                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" >
                                    </a>
                                    <hr>
                                    <p><?php echo "$post_content..." ?></p>
                                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                    <hr style="border-top: 2px dashed black;">
                                
                        <?php   } 

                            }
                    }
                    
                    else{
                            ?>

                            <h1 class="page-header">
                            Top Posts
                            <small></small>
                            </h1>  

                            <?php
                        
                            $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                            $result = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($result)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'], 0, 300);
                                
                        ?>

                                <!-- First Blog Post -->
                                <h2>
                                    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="#"><?php echo $post_author ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                                <hr>
                                <a href="post.php?post_id=<?php echo $post_id ?>">
                                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" >
                                </a>
                                <hr>
                                <p><?php echo "$post_content..." ?></p>
                                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr style="border-top: 2px dashed black;">
                            
                      <?php } 
                    }
                ?>

            </div>