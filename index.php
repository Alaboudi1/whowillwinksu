<?php
   ini_set('display_errors', 1);
   session_start();
   ?>
<!doctype html>
<html lang="en">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <head>
      <meta charset="UTF-8">
      <title>WhoWillWin</title>
      <link rel="stylesheet" href="css/index.css" type="text/css" />
      <script src="https://cdn.auth0.com/js/lock/10.14/lock.min.js"></script>
      <script>
         const lock = new Auth0Lock('KboeNyt4_yis5dVEQ5CSR4VYqEKRh_n5', 'whowillwin.auth0.com', {
             auth: {
                 redirectUrl: "https://whowillwinksu.herokuapp.com"
             }
         });
      </script>
      <?php
         include 'php/uiRender.php';
         include 'php/auth.php';
         // if the user information is in the session, get it, otherwise call auth funtion.
         $userInfo = $_SESSION['auth0__user'];
         if (!$userInfo)
             $userInfo = auth();
         ?>
   </head>
   <body>
      <img src="img/Cham_7.jpg" class="background"></img>
      <nav>
         <img src="img/logo.png" class="logo"></img>
      </nav>
      <div class="title">
         <div>Who Will Win?</div>
         <select name="Team2" id='searchedTeam'>
            <option value="All">All </option>
            <option value="2">Al-Nassr </option>
            <option value="3">Al-Hilal</option>
            <option value="1">Al-Shabab</option>
            <option value="5">Al-Ahli</option>
            <option value="4">Ittihad </option>
         </select>
         <button id="search">Search</button>
      </div>
      <div class="container">
         <div class="loader" id='loader'></div>
         <table class="table" id="table">
            <tbody>
            </tbody>
         </table>
      </div>
      <div class="login">
         <?php
            //if the user is not loged in, display the login button
            //if the user is loged in, check its privilege in the session, if it is not there, call getUserPrivilege function and store the retrieved privilege in the session.
            // then check if the privilege is All, then call addMatch function.
            if (!$userInfo) {
                echo logInButton();
            } else {
                $Privilege = $_SESSION['Privilege'];
                if (!$Privilege) {
                    $Privilege             = getUserPrivilege($userInfo['user_id']);
                    $_SESSION['Privilege'] = $Privilege;
                }
                if ($Privilege == 'ALL') {
                    echo addMatch();
                }
                $img = $userInfo['picture'];
                echo profile($img);
            }
            ?>
      </div>
      <script type="text/javascript" src="js/index.js"></script>
   </body>
</html>