
//Les jobs des utilisateurs sous forme de pieChart
$(document).ready(function(){
	$.ajax({
		
		url: "php/graphdata_users.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var player = [];
			var score = [];
			var Color= []; //Tableau qui stockera les couleurs pour le graphe
			var json = JSON.parse(data);
			
			var dynamicColors = function() {//Allocation aleatoire dune couleur
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
			};
			
			
			var sum_score=0;
			var cpt=0;
			for(var i in json) {
				player.push(json[i].playerid);
				score.push(json[i].score);
				Color.push(dynamicColors());
				sum_score=sum_score+json[i].score;
				cpt++;
			}
			var moy=sum_score/cpt;
			
			var chartdata = {
				labels: player,
				datasets : [
					{
						
						backgroundColor: Color,
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					}
				]
			};
			

			var ctx = $("#mycanvas1");
			var barGraph = new Chart(ctx, {
				type: 'doughnut',
				data: chartdata
			});
			
			
		},
		error: function(data) {
			console.log(data);
		}
	});
});

