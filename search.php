<!-- database connection -->
<?php include "includes/db_connect.php" ?>

<!-- header -->
<?php include "includes/header.php" ?>

<!-- navigation -->
<?php include "includes/navigation.php" ?>

<div class="container">

        <div class="row">

            <!-- blog entries column -->
            <div class="col-md-8">

                <?php 

                    if(isset($_POST['submit'])){

                        $search = $_POST['search'];

                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $result = mysqli_query($connection, $query);

                        if(!$result){
                            die("QUERY FAILED" . mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($result);
                        if($count == 0){
                            echo "NO ROWS";
                        }
                        else{

                            while($row = mysqli_fetch_assoc($result)){
                                
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'], 0, 300);
                                
                ?>
        
                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>
            
                                <!-- First Blog Post -->
                                <h2>
                                    <a href="#"><?php echo $post_title ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"><?php echo $post_author ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                                <hr>
                                <p><?php echo "$post_content..." ?></p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            
                                <hr>

                <?php       
                            } 

                        }

                    }

                ?>

            </div>

            
<!-- blog sidebar -->
<?php include "includes/sidebar.php" ?>

<!-- footer -->
<?php include "includes/footer.php" ?>