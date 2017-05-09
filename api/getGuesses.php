<?php
include '../db/dbConnection.php';

    $matchId =  $_GET['matchId'];
    $query = "SELECT * from `GUESS` WHERE `MATCH-ID` = '$matchId'";
    $result = mysqli_query($connection, $query);
    if(!$result) return;
    while($row = mysqli_fetch_assoc($result)){
    $guess[]= array (
        'team1Goals'=>$row['TEAM1-GOALS'],
        'team2Goals'=>$row['TEAM2-GOALS'],
        );
    }
    $connection->close();

    echo json_encode($guess);

?>