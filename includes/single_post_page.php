<div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <?php 
                
                    if(isset($_GET['post_id'])){
                        $post_id = $_GET['post_id'];
                    }

                    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                    $result = mysqli_query($connection, $query);
                    // confirmQuery($result);

                    while($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                    }
                
                ?>

                <?php 
                    if($post_status === 'draft'){
                        echo "<h1> Post Not Available </h1>";
                        echo "<h5> Redirecting to Admin in 10 seconds</h5>";
                        echo "<script>setTimeout(function(){window.location.href = './admin/posts.php';}, 1000)</script>";
                    }
                    else{
                ?>
                        <!-- Blog Post -->

                        <!-- Title -->
                        <h1><?php echo "$post_title"; ?></h1>

                        <!-- Author -->
                        <p class="lead">
                            by <a href="#"><?php echo "$post_author"; ?></a>
                        </p>

                        <hr>

                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "$post_date"; ?></p>
                        <!-- August 24, 2013 at 9:00 PM -->

                        <hr>

                        <!-- Preview Image -->
                        <img class="img-responsive" src="images/<?php echo "$post_image"; ?>" alt="">

                        <hr>

                            <!-- Post Content -->

                            <?php echo "<p>$post_content</p>"; ?>


                            <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->

                        <hr>

                        <?php include "includes/comments.php" ?>

                <?php } ?>
                
            </div>