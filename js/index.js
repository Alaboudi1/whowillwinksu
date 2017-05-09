const search = document.getElementById('search');
const table = document.getElementById('table');
const loader = document.getElementById('loader');
let matches = [];
const teams = new Map();
// this very long function is the function responsible  for displaying each match in a row inside the matches table
const render = (match) => {
    const row = document.createElement('TR');
    const team1 = document.createElement('TD');
    const team1Image = document.createElement('img');
    const team2 = document.createElement('td');
    const team2Image = document.createElement('img');
    const VS = document.createElement('td');
    const VsImage = document.createElement('img');
    const guess = document.createElement('td');
    const link = document.createElement('a');
    const hrefLink = document.createAttribute('href');
    hrefLink.value = buildURL(match.team1, match.team2, match.id);
    const guessImage = document.createElement('img');

    const imgClass1 = document.createAttribute('class');
    imgClass1.value = "teamImage";
    const imgClass2 = document.createAttribute('class');
    imgClass2.value = "teamImage";
    const vsClass = document.createAttribute('class');
    vsClass.value = "vs";
    const guessClass = document.createAttribute('class');
    guessClass.value = "hint";

    team1Image.src = match.team1.image;
    team1Image.setAttributeNode(imgClass1);
    team2Image.src = match.team2.image;

    team2Image.setAttributeNode(imgClass2);
    VsImage.src = './img/Vs.pn_.png';
    VsImage.setAttributeNode(vsClass);
    guessImage.src = './img/guess.png';
    guessImage.setAttributeNode(guessClass);
    link.setAttributeNode(hrefLink);
    team1.appendChild(team1Image);
    link.appendChild(guessImage);
    team2.appendChild(team2Image);
    VS.appendChild(VsImage);
    guess.appendChild(link);
    row.appendChild(team1);
    row.appendChild(VS);
    row.appendChild(team2);
    row.appendChild(guess);
    table.appendChild(row);
};
//this function builds the URL used to send the match information to guess,php
const buildURL = (team1, team2, matchId) => {
    let URL = "guess.php?";
    for (const prop in team1) {
        URL += `team1${prop}=${team1[prop]}&`;
    }
    for (const prop in team2) {
        URL += `team2${prop}=${team2[prop]}&`;
    }
    return `${URL}matchId=${matchId}`;
};
//this function gets all teams finromation from the database
const getTeamsInfo = () => {
    const url = `api/getTeamsInfo.php`;
    return fetch(url)
        .then(response => response.json())
        .then(teamsinfo => {
            teamsinfo.forEach(team => teams.set(team.Id, team));
            Promise.resolve();
        })
        .catch(e => Promise.reject(e));
};
// this return an array contains only matches that the user selectes. if user select ALL, then all matches displyed. 
const filterTeams = (wantedTeam) => {
    if (wantedTeam === "All") return matches;
    return matches.filter(elm => wantedTeam === elm.team1.Id || wantedTeam === elm.team2.Id);
};
// this function is called when the user clicks on search button
const searchTeam = () => {
    const wantedTeam = document.getElementById("searchedTeam").value;
    const searchedMatches = filterTeams(wantedTeam);
    table.innerHTML = '';
    searchedMatches.forEach(render);
};
// load all matches information from the database.
const loadMatches = () => {
    const url = `api/loadMatches.php`;
    return fetch(url)
        .then(response => response.json())
        .then(matchesInfo => {
            matches = matchesInfo
                .map(match => ({
                    id: match.id,
                    team1: teams.get(match.team1Id),
                    team2: teams.get(match.team2Id)
                }));
            Promise.resolve();
        })
        .catch(e => Promise.reject(e));
};
search.addEventListener('click', searchTeam);
//get all teams information after loading the page to cache it for later use
document.addEventListener("DOMContentLoaded", _ => {
    getTeamsInfo()
        .then(loadMatches)
        .then(_ => {
            matches.forEach(render);
            loader.classList.add('hide');
        })
        .catch(e => console.log(e));
});
