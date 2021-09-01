<?php 

    function confirmQuery($result){
        global $connection;
        if(!$result){
            die('QUERY FAILED') . mysqli_error($connection);
        }
    }

    // function to insert new categories into the categories table in the database
    function insertCategories(){

        global $connection;
        // query to insert new categories into the categories table in the database

                                    if(isset($_POST['add_category'])){
                                    $cat_title = $_POST['cat_title'];
                                    
                                    if($cat_title == "" || empty($cat_title)){
                                        echo '<script>setTimeout(function(){alert("This field cannot be empty")}, 2000)</script>';
                                    }
                                    else{
                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUE('{$cat_title}') ";
                                        
                                        $result = mysqli_query($connection, $query);
                                        if(!$result){
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    }
                                }
                            
    }

    // function to get all categories from the categories table in the database
    function getAllCategories(){

        global $connection;
        // this is a query to get all the categories from the database
        $query = "SELECT * FROM categories";
                                        $result = mysqli_query($connection, $query);
                                        // $row = mysqli_fetch_assoc($result);
                                        // var_dump($row);
                
                                        while($row = mysqli_fetch_assoc($result)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];

                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                            echo "</tr>";
                                        }

    }

    function deleteCategory(){

        global $connection;
        // this is a query to delete a perticular category from the database
        if(isset($_GET['delete'])){
            $cat_id_to_delete = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete} ";
            $result = mysqli_query($connection, $query);
            header("Location: categories.php");
        }

    }

?>