<!-- form to update categories in the categories table in the database -->
<form action="" method="post">
                                <div class="form-gorup">
                                    
                                    <label for="cat_title">Update Category</label>

                                    <?php 
                                
                                        if(isset($_GET['edit'])){
                                            $cat_id_to_edit = $_GET['edit'];
                                            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_to_edit} ";
                                            $result = mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($result)){
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];

                                    ?>
                                                <input value="<?php if(isset($cat_title)){echo "$cat_title";} ?>" class="form-control" type="text" name="cat_title">
                                    
                                      <?php }
                                        }
                                    ?>

                                    <?php 
                                    
                                        if(isset($_POST['update_category'])){
                                            $cat_title_to_update = $_POST['cat_title'];
                                            $query = "UPDATE categories SET cat_title = '{$cat_title_to_update}' WHERE cat_id = '{$cat_id}'";
                                            $result = mysqli_query($connection, $query);
                                            confirmQuery($result);
                                        }
                                    
                                    ?>

                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>