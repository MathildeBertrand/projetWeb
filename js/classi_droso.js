$(document).ready(function(){
	var ctx = $("#mycanvas6").get(0).getContext("2d");

	var data = [
		{
			value: 89,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "Oxidoreductase"
		},
		{
			value: 271,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "Transferases"
		},
		{
			value: 222,
			color: "orange",
			highlight: "darkorange",
			label: "Hydrolases"
		},
		{
			value: 35,
			color: "pink",
			highlight: "pink",
			label: "Lyases"
		},
		{
			value: 23,
			color: "yellow",
			highlight: "yellow",
			label: "Isomerases"
		},
		{
			value: 45,
			color: "green",
			highlight: "green",
			label: "Ligases"
		}
	];

	var chart = new Chart(ctx).Pie(data);
	
});


