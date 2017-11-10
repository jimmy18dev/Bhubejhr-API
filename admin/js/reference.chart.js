Chart.defaults.global.defaultFontColor = '#999999';
Chart.defaults.global.defaultFontSize = '8';

$(document).ready(function(){
    var ref_id = $('#ref_id').val();
    requestData(ref_id);
});

function requestData(ref_id){

	$.ajax({
		url         :'api.reference.php',
		cache       :false,
		dataType    :"json",
		type        :"GET",
		data:{
			request      :'allday_usage',
			ref_id       :ref_id,
		},
		error: function (request, status, error) {
			console.log("Request Error");
		}
	}).done(function(data){
        var dataItems   = data.dataset;
        var hours       = [];
        var usage       = [];

        console.log(dataItems);

        $.each(dataItems,function(k,v){
            hours.push(v.hours);
            usage.push(v.usage);
        });

		graphRender(usage,hours);
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
                        // beginAtZero: true,
                        // stepSize: 10
                        suggestedMax: 50
                    },
                    position: "right",
                }],
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