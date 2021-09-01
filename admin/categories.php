<!-- header -->
<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <!-- <small>Author</small> -->
                        </h1>
                        <div class="col-xs-6">

                            <!-- form to insert new categories into the categories table in the database -->
                            <form action="" method="post"> 
                                <div class="form-gorup">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
                                </div>
                            </form>

                            <?php // this php function from the functions.php file contains the code to insert new categories into the database using the above form
                            
                                insertCategories();                                
                            ?> 

                            <?php // this php code will add the category update form in the categories.php page when the edit button is pressed
                            
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                }
                            
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php // this is a php function from the functions.php file to get all the categories from the database
                                        getAllCategories();
                                    ?>

                                    <?php // this is a php function from the functions.php file to delete a perticular category from the database
                                        deleteCategory();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>