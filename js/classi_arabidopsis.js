$(document).ready(function(){
	var ctx = $("#mycanvas5").get(0).getContext("2d");

	var data = [
		{
			value: 1,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 0,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 0,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 0,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 0,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 0,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});


