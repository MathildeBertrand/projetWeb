var ctx = document.getElementById("popChart").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Total enzymes in db","Enzyme with only SP", "Enzyme with SP and Prosite", " Enzyme with only Prosite", "Enzyme without SP & Prosite"],
        datasets: [{
            
            data: [6198,51, 1232, 2734, 2181],
            backgroundColor: [
                'rgba(55, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(155, 200, 86, 0.2)'

            ],
            borderColor: [
                'rgba(55, 99, 132, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(155, 200, 86, 1)'
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
