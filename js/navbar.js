// Handles burger menu button
// Horizontal Navigation Bar
// Will delete later if design suggests
function burgir(){
    var navBar = document.getElementById("navbar");
    if(navBar.classList.contains("navbar-show")){
        navBar.classList.remove("navbar-show");
    }else{
        navBar.classList.add("navbar-show");
    }
}

// for ranking in learderboard
function rankTable() {
    const table = document.getElementById('rankingTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));

    // Sort rows based on the score (third column)
    rows.sort((a, b) => {
        const scoreA = parseInt(a.cells[2].innerText);
        const scoreB = parseInt(b.cells[2].innerText);
        return scoreB - scoreA; // Sort in descending order
    });

    // Rebuild the table with sorted rows and assign ranks
    rows.forEach((row, index) => {
        row.cells[0].innerText = index + 1; // Assign rank
        tbody.appendChild(row); // Reorder row in the table
    });
}

window.onload = rankTable;