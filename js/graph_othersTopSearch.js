
//graph dans account pour top searched des autres
$(document).ready(function(){
	$.ajax({
		url: '../page/json_othersTopSearch.php',
		method: 'GET',
		success: function(data){
			console.log(data);
			var x=[];
			var y=[];
						
			for (var i in data){
				x.push(data[i].name);
				y.push(data[i].cpt);
			}
						
			var chartdata={
				labels: x,
				datasets:[
					{
						label: 'occurence',
						backgroundColor: 'rgba(200,200,200,0.75)',
						borderColor: 'rgba(200,200,200,0.75)',
						hoverBackgroundColor: 'rgba(200,200,200,1)',
						hoverBorderColor: 'rgba(200,200,200,1)',
						data: y
					}
				]
			};
						
			var ctx=$("#othersCanvas");
						
			var barGraph=new Chart(ctx, {
				type:'bar',
				data: chartdata,
								options: {scales: { yAxes: [{ ticks: { beginAtZero:true } }],
									
								 yAxes: [{ gridLines: {display: true} }],
								 yAxes: [{ scaleLabel: {display: true,labelString: "Occurrence" } }],

								 xAxes: [{ scaleLabel: {display: true,labelString: "Popular searched key words" } }],
				 },
				legend: {
					display:false,
					}
				},
			});
		},
		error: function(data){
			console.log(data);
		}
	});
});
