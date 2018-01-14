$(document).ready(function(){
	var ctx = $("#mycanvas2").get(0).getContext("2d");

	var data = [
		{
			value: 436,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 1287,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 1035,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 133,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 99,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 138,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});



