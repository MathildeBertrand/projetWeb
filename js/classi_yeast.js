$(document).ready(function(){
	var ctx = $("#mycanvas3").get(0).getContext("2d");

	var data = [
		{
			value: 206,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 633,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 438,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 80,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 57,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 100,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});




