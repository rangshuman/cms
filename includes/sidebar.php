<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name= "search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name= "submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Login Form -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input name="user_password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="login" value="Login">
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                                <?php 
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connection, $query);
                                    // $row = mysqli_fetch_assoc($result);
                                    // var_dump($row);
            
                                    while($row = mysqli_fetch_assoc($result)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li><a href='index.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                                    }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

            </div>

        </div>
        <!-- /.row -->