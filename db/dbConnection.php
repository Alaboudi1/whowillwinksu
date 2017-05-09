<?php
// connection credentials
    $host = "mysql1.gear.host";
    $user = "opensource";
    $pass = "openSource@123";
    $db = "openwhowillwin";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
?>