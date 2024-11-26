fetch("php.dashboard/dashboard-user-graph.php")
.then((response) => response.text())  // Get response as text
.then((text) => {
    console.log(text);  // Log the raw response to the console
    return JSON.parse(text);  // Manually parse the text
})
.then((data) => {
    createChart(data, 'line');
})
.catch((error) => {
    console.error('Error parsing JSON:', error);
    return;
});

const chartEl = document.getElementById("myChart");
chartEl.height = 100;

function createChart(chartData, type) {
    new Chart('myChart', {
    type: type,
    data: {
        labels: chartData.map(row => row.date),
        datasets: [{
            fill: false,
            lineTension: 0,
            label: 'Completed Habits',
            borderColor: "rgba(99, 153, 61,0.8)",
            backgroundColor: "rgba(99, 153, 61,0.6)",
            fill: 'start',
            data: chartData.map(row => row.completed_habits)
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                stacked: true,
                ticks: {
                    stepSize: 1,
                    autoSkip: true,
                    beginAtZero: true,
                    callback: function (value) {
                        // Skipping decimal points
                        return Math.floor(value);
                    }
                },
            }
        }
    }
    });
}