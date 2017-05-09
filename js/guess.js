const some = new URLSearchParams(window.location.search);
const matchId = some.get('matchId');
const team1Name = some.get('team1name');
const team2Name = some.get('team2name');

const guessDiv = document.getElementById('guess');
const guessButton = document.getElementById('guessButton');
const loader = document.getElementById('loader');
const result = document.getElementById('result');
guessButton.addEventListener('click', _ => guess());

// hide the guess button, display the loader, save the guess to the database, then display the update guess button.
const guess = () => {
    const Team1goals = parseInt(document.getElementById("goalsTeam1").value);
    const Team2goals = parseInt(document.getElementById("goalsTeam2").value);
    const guessId = guessDiv.dataset.guessId;
    guessDiv.classList.add('hide');
    loader.classList.remove('hide');
    if (guessId) {
        updateGuess(Team1goals, Team2goals, guessId)
            .then(_ => {
                guessDiv.classList.remove('hide');
                loader.classList.add('hide');
                updatePresentage();
            });
    }
    else {
        saveGuess(Team1goals, Team2goals)
            .then(guessId => updateButton(guessId))
            .then(_ => {
                guessDiv.classList.remove('hide');
                loader.classList.add('hide');
                updatePresentage();
            });
    }
};
// save the guess to the database
const saveGuess = (Team1goals, Team2goals) => {
    return fetch(`api/saveGuess.php?matchId=${matchId}&team1goals=${Team1goals}&team2goals=${Team2goals}`, {
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(guessId => Promise.resolve(guessId));

};
//save the updated guess to the database
const updateGuess = (Team1goals, Team2goals, guessId) => {
    return fetch(`api/updateGuess.php?team1goals=${Team1goals}&team2goals=${Team2goals}&guessId=${guessId}`, {
        credentials: 'same-origin'
    }).then(_ => Promise.resolve());
};
//get the guess fromt he database
const getGuesses = (matchId) => {
    return fetch(`api/getGuesses.php?matchId=${matchId}`)
        .then(response => response.json())
        .then(guesses => Promise.resolve(guesses));
};
//display the update guess button
const updateButton = (guessId) => {
    guessDiv.dataset.guessId = guessId;
    guessButton.innerHTML = 'update guess';
    return Promise.resolve();
};
//calculate the overall guesses for this match
const calPresentage = (guesses) => {
    let team1Wins = 0;
    let team2Wins = 0;
    guesses.forEach(guess => {
        if (parseInt(guess.team1Goals) > parseInt(guess.team2Goals))
            team1Wins++;
        else if (parseInt(guess.team1Goals) < parseInt(guess.team2Goals))
            team2Wins++;
    });
    const team1Presentage = Math.round((team1Wins / guesses.length) * 100);
    const team2Presentage = Math.round((team2Wins / guesses.length) * 100);
    return Promise.resolve({
        team1Presentage,
        team2Presentage
    });
};
//display the result of the overall guesses of this match
const renderPersntage = (team1Presentage, team2Presentage) => {
    if (team1Presentage > team2Presentage) {
        result.innerHTML = `People predict that ${team1Name} is going to win ✌.`;
    }
    else if (team2Presentage > team1Presentage) {
        result.innerHTML = `People predict that ${team1Name} is going to win ✌.`;
    }
    else {
        result.innerHTML = `People predict this match is going to end in a tie 🤝.`;
    }
};
//this function is get called to update the overall guesses from all the user
const updatePresentage = () => {
    getGuesses(matchId)
        .then(guesses => calPresentage(guesses))
        .then(presentage => renderPersntage(presentage.team1Presentage, presentage.team2Presentage));

}

document.addEventListener("DOMContentLoaded", _ => updatePresentage());
