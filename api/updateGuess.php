
<?php
include '../db/dbConnection.php';
    session_start() ;

    $guessId   =   $_GET['guessId'];
    $team1Goals =  $_GET['team1goals'];
    $team2Goals =  $_GET['team2goals'];

    $sql= "UPDATE `GUESS` SET `TEAM1-GOALS`= '$team1Goals' ,`TEAM2-GOALS`= '$team2Goals' WHERE `GUESS-ID`='$guessId'";
    mysqli_query($connection, $sql);
    $connection->close();
?>