<!doctype html>
<html lang="en">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="Content-Security-Policy" content="img-src 'self' data:; default-src 'self' https://whowillwin.gear.host/index.php https://cdn.auth0.com/js/lock/10.14/lock.min.js">
   <head>
      <meta charset="UTF-8">
      <title>Guess</title>
      <link rel="stylesheet" href="css/guess.css" type="text/css" />
   </head>
   <body>
      <?php
         include 'php/uiRender.php';
         include 'php/userOperations.php';
         //check if the user is authenticated, if not, redirect to index.php
         session_start();
         $user = $_SESSION['auth0__user'];
         if(!$user)
          header("Location:index.php?auth=false");
         ?>
      <img src="img/Cham_7.jpg" class="background"></img>
      <nav>
         <img src="img/logo.png" class="logo"></img>
      </nav>
      <div class="title">Who Will Win?</div>
      <span id="result" class="result"></span>
      <table class="guessTable">
         <tbody>
            <?php
               echo guessMatch();
               ?>
            <tr>
               <td>
                  <lable for="goalsTeam1"> How many goals you expect?
                  </lable>
               </td>
               <td>
               </td>
               <td>
                  <lable for="goalsTeam2"> How many goals you expect?
                  </lable>
               </td>
            </tr>
         </tbody>
      </table>
      <?php
         // retrieve user guess from the database. 
          $userId = $user['user_id'];
          $matchId = $_GET['matchId'];
          $guess = getUserGuess($userId,$matchId);
          echo guessGoals($guess);
         ?>
      <div class="loader hide" id="loader"></div>
      <a class="back" href="./index.php">Back</a>
      <script type="text/javascript" src="./js/guess.js"></script>
</html>