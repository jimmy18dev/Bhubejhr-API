var api_url = 'api.reference.php';

$(document).ready(function(){
	$btnUpdate 		= $('#btnUpdate');
	$btnCreate 		= $('#btnCreate');
	$progressbar 	= $('#progressbar');

	// Default selection
	$('#method-items-'+$('#method').val()).addClass('-active');
	$('#type-items-'+$('#type').val()).addClass('-active');
	$('#category-items-'+$('#category').val()).addClass('-active');

	$btnUpdate.click(function(){
		var ref_id 		= $('#ref_id').val();
		var name 		= $('#name').val();
		var desc 		= $('#desc').val();
		var example		= $('#example').val();

		if(name == '') return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'edit',
	            name:name,
	            desc:desc,
	            example:example,
	            ref_id:ref_id
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	            $progressbar.animate({width:'0%'},500);
	        }
	    }).done(function(data){
	    	console.log(data);
	    	$progressbar.animate({width:'100%'},500);

	    	setTimeout(function(){
	    		$progressbar.fadeOut();
	    	}, 1000);
	    });	
	});

	$btnCreate.click(function(){
		var name 		= $('#name').val();
		var desc 		= $('#desc').val();
		var example		= $('#example').val();
		var category 	= $('#category').val();
		var method 		= $('#method').val();
		var type 		= $('#type').val();

		if(name == '') return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'create',
	            name:name,
	            desc:desc,
	            example:example,
	            category:category,
	            method:method,
	            type:type,
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	            $progressbar.animate({width:'0%'},500);
	        }
	    }).done(function(data){
	    	console.log(data.reference_id);
	    	$progressbar.animate({width:'100%'},500);

	    	setTimeout(function(){
	    		window.location = 'reference-page.php?id='+data.reference_id;
	    	},1000);
	    });	
	});

	$('#referenceMethod').on('click','.method-items',function(){
		var method = $(this).attr('data-method');
		$('.method-items').removeClass('-active');
		$(this).addClass('-active');
		$('#method').val(method);
	});

	$('#referenceType').on('click','.type-items',function(){
		var type = $(this).attr('data-type');
		$('.type-items').removeClass('-active');
		$(this).addClass('-active');
		$('#type').val(type);
	});

	$('#referenceCategory').on('click','.category-items',function(){
		var category = $(this).attr('data-id');
		$('.category-items').removeClass('-active');
		$(this).addClass('-active');
		$('#category').val(category);
	});
});