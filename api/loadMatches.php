<?php
include '../db/dbConnection.php';

    $query = "SELECT * FROM MATCHES";
    $result = mysqli_query($connection, $query);
    $matches = array();
    while($row = mysqli_fetch_assoc($result)){
    $matches[] = array (
        'id'=>$row['MATCH-ID'],
        'team1Id'=>$row['TEAM1-ID'],
        'team2Id'=>$row['TEAM2-ID'],
        );
    }
    $connection->close();

   echo json_encode($matches);
?>