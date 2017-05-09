 <?php
 // kill the session and redirect the user to index.php
 //this will make the user logout
    session_start() ;
    session_destroy();
     header("Location: ../index.php");
    ?>