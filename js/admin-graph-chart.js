fetch("php.dashboard/dashboard-admin-graph.php")
.then((response) => response.text())  // Get response as text
.then((text) => {
    // console.log(text);  // Log the raw response to the console
    return JSON.parse(text);  // Manually parse the text
})
.then((data) => {
    createChart(data, 'line');
})
.catch((error) => {
    console.error('Error parsing JSON:', error);
    return;
});
// const chartData = [
//     { date: '2024-01-01', registered_users: 3, total_habits: 13, total_completed_habits: 8 },
//     { date: '2024-01-02', registered_users: 5, total_habits: 20, total_completed_habits: 10 },
// ];
// createChart(chartData, 'line');

const chartEl = document.getElementById("myChart");

function createChart(chartData, type) {
    new Chart('myChart', {
    type: type,
    data: {
        labels: chartData.map(row => row.date),
        datasets: [
            {
                fill: false,
                lineTension: 0,
                label: 'Registered Users',
                borderColor: "rgba(32, 77, 0, 0.8)",
                backgroundColor: "rgba(32, 77, 0,0.6)",
                fill: 'start',
                data: chartData.map(row => row.registered_users),
                yAxisID: 'y',
            },
            {
                fill: false,
                lineTension: 0,
                label: 'Total Habits',
                borderColor: "rgba(175, 220, 143,0.8)",
                backgroundColor: "rgba(175, 220, 143,0.6)",
                fill: 'start',
                data: chartData.map(row => row.total_habits),
                yAxisID: 'y',
            },
            {
                fill: false,
                lineTension: 0,
                label: 'Completed Habits',
                borderColor: "rgba(99, 153, 61,0.8)",
                backgroundColor: "rgba(99, 153, 61,0.6)",
                fill: 'start',
                data: chartData.map(row => row.total_completed_habits),
                yAxisID: 'y',
            }
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    autoSkip: true,
                    callback: function (value) {
                        // Skipping decimal points
                        return Math.floor(value);
                    }
                },
            },
        }
    }
    });
}