<?php
include '../db/dbConnection.php';
    session_start() ;

    $matchId    =  $_GET['matchId'];
    $userId     =  sha1($_SESSION['auth0__user']['user_id']);
    $team1Goals =  $_GET['team1goals'];
    $team2Goals =  $_GET['team2goals'];

    $query = "INSERT INTO `GUESS`
    (`MATCH-ID`,`USER-ID`, `TEAM1-GOALS`, `TEAM2-GOALS`) VALUES
    ('$matchId','$userId','$team1Goals','$team2Goals')";

     mysqli_query($connection, $query);
     $id = $connection->insert_id;
     $connection->close();
     echo json_encode($id);

?>