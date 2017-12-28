

$(document).ready(function(){
	$.ajax({
		
		url: "data_publi.php",
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
						label: 'Nombre de publications',
						backgroundColor: 'rgba(0, 0, 255, 0.3)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					}
				]
			};
			
		

			var ctx = $("#mycanvas");

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
