$(document).ready(function(){
    requestData();
});

function requestData(){
	$.ajax({
		url         :'http://jhos.api/report?qid=1&token=bd0889c94d3d2957923e89a9ceece126d',
		cache       :false,
		dataType    :"json",
		type        :"POST",
		// data:{
		// 	action      :'request_counter',
		// 	app_id		:app_id,
		// },
		error: function (request, status, error) {
			console.log("Request Error");
		}
	}).done(function(data){

        console.log(data);
        console.log(data.data.items);

        $.each(data.data.items,function(k,v){
            console.log(v.id,v.password,v.username);
        });
	});
}