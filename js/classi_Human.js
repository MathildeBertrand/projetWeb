$(document).ready(function(){
	var ctx = $("#mycanvas").get(0).getContext("2d");

	var data = [
		{
			value: 444,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 1353,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 1144,
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
			value: 103,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 144,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});

