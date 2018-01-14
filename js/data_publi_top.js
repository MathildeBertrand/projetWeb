
//Les enzymes les plus consultes
$(document).ready(function(){
	$.ajax({
		
		url: "data_publi_top.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var player = [];
			var score = [];
			var json = JSON.parse(data);
			
			var sum_score=0;
			var cpt=0;
			for(var i in json) {
				player.push(json[i].playerid);
				score.push(json[i].score);
				sum_score=sum_score+json[i].score;
				cpt++;
			}
			var moy=sum_score/cpt;
			
			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Number of search',
						position: 'right',
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						borderWidth: 1,
						data: score
					}
				]
			};
			
		

			var ctx = $("#mycanvaspub");

			var barGraph = new Chart(ctx, {
				type: 'horizontalBar',
				data: chartdata,
				options: {scales: { yAxes: [{ ticks: { beginAtZero:true } }],
									
								 yAxes: [{ gridLines: {display: false} }],

								 xAxes: [{ scaleLabel: {display: true,labelString: "Number of synonyms " } }],
								 xAxes: [{ ticks: { beginAtZero:true } }],
				 },
				legend: {
					display:false,
					}
				},

				
		});
			
			
		},
		error: function(data) {
			console.log(data);
		}
	});
});


