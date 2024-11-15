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

// Barchart
const barchartData = {
  labels: ["Query Concerns"],
  datasets: [
    {
      label: 'Membership Inquiry',
      data: [56],
      backgroundColor: '#DB2777',
    },
    {
      label: 'IDP Follow up',
      data: [32],
      backgroundColor: '#D97706',
    },
    {
      label: 'Product Issue',
      data: [69],
      backgroundColor: '#EAB208',
    },
    {
      label: 'ERS Inquiry',
      data: [121],
      backgroundColor: '#16A34A',
    },
    {
      label: 'Insurance Quote',
      data: [50],
      backgroundColor: '#0033c4',
    },
  ]
};

const chartDifferentInteractionMode = new Chart($('#barchart'), {
  type: 'bar',
  data: barchartData,
  options: {
    skipNull: true,
    plugins: {
      labels: {
        render: 'value'
      },
      tooltip: {
        title: ['a', 'b']
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
});