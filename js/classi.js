$(document).ready(function(){
	var ctx = $("#mycanvas").get(0).getContext("2d");

	var data = [
		{
			value: 1783,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 1710,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 1569,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 680,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 270,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 186,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});
