<?php
include '../db/dbConnection.php';

    $query = "SELECT * FROM Teams";
    $result = mysqli_query($connection, $query);
    $teams = [];
    while($row = mysqli_fetch_assoc($result)){;
    $teams[] = array (
        'name'=>$row['NAME'],
        'image'=>$row['IMAGE-URL'],
        'webpage'=>$row['PAGE-URL'],
        'Id'=>$row['TEAM-ID'],
        );
}
    $connection->close();

   echo json_encode($teams);
?>