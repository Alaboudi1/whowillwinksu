<?php
 include '../db/dbConnection.php';

    $team1Id = $_GET['team1Id'];
    $team2Id = $_GET['team2Id'];

    $query = "INSERT INTO `MATCHES`(`TEAM1-ID`, `TEAM2-ID`) VALUES ('$team1Id','$team2Id')";
    mysqli_query($connection, $query);
    $id = $connection->insert_id;

    $connection->close();

   echo json_encode($id);


?>



