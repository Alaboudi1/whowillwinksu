<?php
//this returns add match funtionaility in HTML, this should will be displayed when the user has the privilege to add matches. 
function addMatch(){
      return '<div>
                <lable for="Team1">Team 1
                    <select name="Team1" id="Team1">
                      <option value="2">Al-Nassr </option>
                      <option value="3">Al-Hilal</option>
                      <option value="1">Al-Shabab</option>
                      <option value="5">Al-Ahli</option>
                      <option value="4">Ittihad </option>
                    </select>
                </lable>
                <lable for="Team2">Team 2
                    <select name="Team2" id="Team2">
                      <option value="2">Al-Nassr </option>
                      <option value="3">Al-Hilal</option>
                      <option value="1">Al-Shabab</option>
                      <option value="5">Al-Ahli</option>
                      <option value="4">Ittihad </option>
                    </select>
                </lable>
            <div>
            <button id="add">Add</button>
        <div id="error" class="hide">
        "You cannot create match with one team playing against itself"
       </div>
        <script type="text/javascript" src="js/admin.js"></script>';

  }
  //this returns login button in HTML when the user is not loged in.
function logInButton(){
    return "<button onclick='lock.show();'>Login</button>";
}
// this returns the prfile HTML when the user is loged in.
function profile($img){
     return"<div class='profile'>
             <img src = '$img' />
                <div class='logout'>
                <a href='php/logout.php'> logout</>
                </div>
            <div>";
}

//this returns the guess match table.
function guessMatch(){
    return"<tr>
            <td>
                  <img src='$_GET[team1image]' alt='$_GET[team1name]'></img>
            </td>
            <td>
                <img src='img/Vs.pn_.png'></img>
            </td>
            <td>
                     <img src='$_GET[team2image]' alt='$_GET[team2name]'></img>

                    </td>
        </tr>
        <tr>
            <td>
                <a href='$_GET[team1webpage]'> $_GET[team1name] </a>
            </td>
            <td>
            </td>
            <td>
                <a href='$_GET[team2webpage]'> $_GET[team2name] </a>
            </td>
        </tr>";
}
//this returns the guess goals in HTML. if the user has already guessed, his guess should be displayed, otherwise, display an empty guess. 
function guessGoals($guess){
    $ui = "<table class='guessTable'>
                <tbody>
                    <tr>
                        <td>
                            <input type='number' name='goalsTeam1' value='$guess[team1Goals]' id='goalsTeam1' min='0' />
                        </td>
                        <td></td>
                        <td>
                            <input type='number' name='goalsTeam2' value='$guess[team2Goals]' id='goalsTeam2' min='0' />
                        </td>
                    </tr>
                </tbody>
            </table>
          ";
          if(!$guess){
         $ui .= "<div id='guess' class='guessbutton'>
             <button id='guessButton'> guess </button>
          </div>";
          }
          else{
             $ui .= "<div id='guess' data-guess-id='$guess[id]' class='guessbutton'>
             <button id='guessButton'> update guess </button>
          </div>" ;
          }
          return $ui;
}
?>