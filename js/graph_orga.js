

$(document).ready(function(){
	$.ajax({
		
		url: "data_orga.php",
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
						label: 'Number of enzymes',
						backgroundColor: 'rgba(0, 0, 0, 0.8)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						
						data: score
					}
				]
			};
			
		

			var ctx = $("#mycanvasorga");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				
				data: chartdata,
				options: {
					legend: {
					display:true,
					position:'right'}
				},
			});
			
			
		},
		error: function(data) {
			console.log(data);
		}
	});
});

