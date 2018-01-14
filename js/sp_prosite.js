var ctx = document.getElementById("popChart").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Percentage of enzyme with only SP", "enzyme with  SP and Prosite", "Percentage of enzyme with  only Prosite"],
        datasets: [{
            
            data: [(1283/ 6198)*100, (1232/ 6198)*100, (3966/ 6198)*100],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
     options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        legend: {
          display:false
        }
    }
});
