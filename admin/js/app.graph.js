$(document).ready(function(){

    var app_id = $('#app_id').val();
    
	requestData(app_id);
});

function requestData(app_id){
	$.ajax({
		url         :'api.app.php',
		cache       :false,
		dataType    :"json",
		type        :"POST",
		data:{
			action      :'request_counter',
			app_id		:app_id,
		},
		error: function (request, status, error) {
			console.log("Request Error");
		}
	}).done(function(data){
        var dataItems   = data.data.items;
        var requests    = [];
        var date        = [];

        $.each(dataItems,function(k,v){
            requests.push(v.request);
            date.push(v.create_time);
        });

		graphRender(requests.reverse(),date.reverse());
	});
}

function graphRender(requests,date){
    var ctx = document.getElementById("chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: date,
            datasets: [{
                label: 'Last 7 Days.',
                data: requests,
                backgroundColor: '#4CAF50',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            title:{
                display:false
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 1,
                    }
                }]
            }
        }
    });
}