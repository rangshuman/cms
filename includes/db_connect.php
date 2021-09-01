<?php

error_reporting(0);

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $val){
    define(strtoupper($key), $val);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// if($connection){
//     echo "the connection is successful";
// }

?>