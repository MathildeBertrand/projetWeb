$(document).ready(function(){
	var ctx = $("#mycanvas1").get(0).getContext("2d");

	var data = [
		{
			value: 238,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 440,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 281,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 143,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 91,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 74,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});


