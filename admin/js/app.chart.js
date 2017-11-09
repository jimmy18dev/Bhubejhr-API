Chart.defaults.global.defaultFontColor = '#999999';
Chart.defaults.global.defaultFontSize = '10';

$(document).ready(function(){
    var app_id = $('#app_id').val();
    requestData(app_id);
});

function requestData(app_id){
	$.ajax({
		url         :'api.app.php',
		cache       :false,
		dataType    :"json",
		type        :"GET",
		data:{
			request      :'last7day',
			app_id       :app_id,
		},
		error: function (request, status, error) {
			console.log("Request Error");
		}
	}).done(function(data){
        var dataItems   = data.items;
        var day         = [];
        var total       = [];

        console.log(dataItems);

        $.each(dataItems,function(k,v){
            total.push(v.total);
            day.push(v.day);
        });

		graphRender(total,day);
	});
}

function graphRender(total,day){
    var ctx = document.getElementById("chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: day,
            datasets: [{
                label: 'Last 7 Days.',
                data: total,
                backgroundColor: '#4c8279',
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem){
                        return tooltipItem.yLabel;
                    }
                }
            },
            title:{
                display:false
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    position: "left",
                }]
            },
            // animation: {
            //     duration: 0, // general animation time
            // },
            hover: {
                animationDuration: 0, // duration of animations when hovering an item
            },
            responsiveAnimationDuration: 0, // animation duration after a resize
        }
    });
}