$(document).ready(function(){
	var ctx = $("#mycanvas4").get(0).getContext("2d");

	var data = [
		{
			value: 50,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 52,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 12,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 18,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 11,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 9,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});


