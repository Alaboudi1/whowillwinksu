const add = document.getElementById('add');
let errorMessage = false;
let currentmatch;
// display error message when team1Name == team2Name;
// otherwise get teams information and create a new match.
const addMatch = (team1Id, team2Id) => {
    if (team1Id === team2Id) {
        if (!errorMessage) {
            document.getElementById('error').className = "error";
            errorMessage = true;
        }
        return;
    }
    document.getElementById('error').className = "hide";
    errorMessage = false;
    const match = {};
    match.team1 = teams.get(team1Id);
    match.team2 = teams.get(team2Id);
    saveMatch(match)
        .then(currentmatch => {
            render(currentmatch);
            matches.push(currentmatch);
        });
};
// save match to the database
const saveMatch = (match) => {
    currentmatch = match;
    const url = `./api/saveMatch.php?team1Id=${match.team1.id}&team2Id=${match.team2.id}`;
    return fetch(url)
        .then(response => response.json())
        .then(id => {
            currentmatch.id = id;
            return Promise.resolve(currentmatch);
        })
        .catch(e => Promise.reject(e));
};
//call add match funtion when add button is clicked 
add.addEventListener('click', _ => {
    const team1Name = document.getElementById("Team1").value;
    const team2Name = document.getElementById("Team2").value;
    addMatch(team1Name, team2Name);
});
