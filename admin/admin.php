<!-- header -->
<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>(<?php echo $_SESSION['firstname'] ?>)</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM posts";
                                        $result = mysqli_query($connection, $query);
                                        $post_count = mysqli_num_rows($result);
                                        echo "<div class='huge'>{$post_count}</div>";

                                        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                                        $result = mysqli_query($connection, $query);
                                        $draft_posts_count = mysqli_num_rows($result);
                                    ?>
                                    <div>Total posts</div>
                                    <div>(<?php echo "{$draft_posts_count}"; ?> Draft)</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM comments";
                                        $result = mysqli_query($connection, $query);
                                        $comment_count = mysqli_num_rows($result);
                                        echo "<div class='huge'>{$comment_count}</div>";

                                        $query = "SELECT * FROM comments WHERE comment_status = 'rejected'";
                                        $result = mysqli_query($connection, $query);
                                        $unapproved_comment_count = mysqli_num_rows($result);
                                    ?>
                                    <div>Total comments</div>
                                    <div>(<?php echo "{$unapproved_comment_count}"; ?> Unapproved)</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM users";
                                        $result = mysqli_query($connection, $query);
                                        $user_count = mysqli_num_rows($result);
                                        echo "<div class='huge'>{$user_count}</div>";

                                        $query = "SELECT * FROM users WHERE user_status = 'pending'";
                                        $result = mysqli_query($connection, $query);
                                        $pending_user_count = mysqli_num_rows($result);
                                    ?>
                                    <div> Total users</div>
                                    <div>(<?php echo "{$pending_user_count}"; ?> Pending)</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $result = mysqli_query($connection, $query);
                                        $categories_count = mysqli_num_rows($result);
                                        echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php 
                                    $element_name = ['Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Pending Users', 'Categories'];
                                    $element_count = [$post_count, $draft_posts_count, $comment_count, $unapproved_comment_count, $user_count, $pending_user_count, $categories_count];

                                    for($i=0; $i<7; $i++){
                                        echo "['{$element_name[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                                ?>

                                // ['Element Name', '1000'],

                            ]);

                            var options = {
                                chart: {
                                    title: 'CSM Data',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>