<?php
//This gets user twitter id, hash it and then saves to the database
function saveUser ($twitterId) {
include 'db/dbConnection.php';

    $user =  sha1($twitterId);
    $query = "INSERT INTO `USERS` (`USER-ID`, `PRIVILEGE`) VALUES ('$user','GUESS')";
    mysqli_query($connection, $query);

    $connection->close();
}
// this gets user id, hash it , looks up user privilege and retun it.
function getUserPrivilege ($twitterId) {
include 'db/dbConnection.php';

    $user =  sha1($twitterId);
    $query = "SELECT `PRIVILEGE` FROM `USERS` WHERE `USER-ID` = '$user'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $PRIVILEGE = $row["PRIVILEGE"];
    $connection->close();
    return $PRIVILEGE;
}
// this gets user id and match id, hash the user id , looks up user guess and returns it.

function getUserGuess ($twitterId,$matchID) {
include 'db/dbConnection.php';

    $user =  sha1($twitterId);
    $query = "SELECT * from `GUESS` WHERE `USER-ID` = '$user' && `MATCH-ID` = '$matchID'";
    $result = mysqli_query($connection, $query);
    if(!$result) return;
    $row = mysqli_fetch_assoc($result);
   if($row){
    $guess = array (
        'id'=>$row['GUESS-ID'],
        'team1Goals'=>$row['TEAM1-GOALS'],
        'team2Goals'=>$row['TEAM2-GOALS'],
        );
    }
    $connection->close();

    return $guess;
}
?>