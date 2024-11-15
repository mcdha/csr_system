const piechartData = {
    labels: [
        'Resolved',
        'Pending'
    ],
    datasets: [{
        label: 'Query Statuses',
        data: [resolvedQueriesCount, pendingQueriesCount],
        backgroundColor: [
            '#16A34A',
            '#EAB208'
        ],
        hoverOffset: 4
    }]
};

new Chart($('#piechart'), {
    type: 'pie',
    data: piechartData,
    options: {
        title: {
            display: false
        },
        plugins: {
            labels: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 20,
            }
        }
    },
});

var backgroundColors = [
    '#DB2777',
    '#D97706',
    '#EAB208',
    '#16A34A',
    '#0033c4',
    '#7C3AED'
];

// Barchart
const barchartData = {
    labels: ["Query Concerns"],
    datasets: concernsCountArray.map((concern, index) => ({
        label: concern['concern'],
        data: [concern['count']]
    }))
};

const chartDifferentInteractionMode = new Chart($('#barchart'), {
    type: 'bar',
    data: barchartData,
    options: {
        colors: {
            enabled: true
        },
        skipNull: true,
        plugins: {
            labels: {
                render: 'value'
            },
            tooltip: {
                title: ['a', 'b']
            },
            colorschemes: {
                scheme: 'tableau.Tableau10'
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }],
            xAxes: [{
                position: 'top',
                ticks: {
                    padding: 20
                }
            }],
        }
    },
});