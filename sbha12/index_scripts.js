
function handleWordClick(word_id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const wordBox = document.getElementById('word-box-' + word_id);
            wordBox.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "update_clicks.php?word_id=" + word_id, true);
    xhttp.send();
}

let timeSpent = 0;

function updateTimeSpent() {
    timeSpent++;
    // Send the updated time spent to the server to update the user_time table.
    if (timeSpent % 60 === 0) { // Update the server every 60 seconds.
        updateServerTimeSpent(timeSpent);
    }
}

function updateServerTimeSpent(time) {
    // Make an AJAX request to update the user_time table with the new time spent.
    constxhr = new XMLHttpRequest();
    xhr.open("GET", `update_time_spent.php?time=${time}`, true);
    xhr.send();
}

// Call updateTimeSpent() every second to track the user's time spent on the site.
setInterval(updateTimeSpent, 1000);

// Update the server when the user leaves the page.
window.addEventListener("beforeunload", () => {
    updateServerTimeSpent(timeSpent);
}); 