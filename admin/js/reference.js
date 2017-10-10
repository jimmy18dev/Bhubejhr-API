var api_url = 'api.reference.php';

$(document).ready(function(){
	$btnCreateReference 		= $('#btnCreateReference');
	$createReferenceDialog 		= $('#createReferenceDialog');
	$createDialogFilter 		= $('#createDialogFilter');
	$btnCloseCreateReference 	= $('#btnCloseCreateReference');
	$btnSubmitCreateReference 	= $('#btnSubmitCreateReference');
	$btnDeleteReference 		= $('#btnDeleteReference');

	$btnCreateReference.click(function(){
		$createReferenceDialog.fadeIn(100);
		$createDialogFilter.fadeIn(300);
		$('#reference_name').focus();
	});

	$btnCloseCreateReference.click(function(){
		closeDialog();
	});

	function closeDialog(){
		$createReferenceDialog.fadeOut(300);
		$createDialogFilter.fadeOut(300);
		$btnDeleteReference.fadeOut(100);

		$('#reference_id').val();
	    $('#reference_name').val();
	    $('#reference_description').val();
	    $('#reference_method').val();
	    $('#reference_category').val();
	    $('#reference_type').val();

	    $('.method-items').removeClass('-active');
	    $('.type-items').removeClass('-active');
	    $('.category-items').removeClass('-active');
	}

	$('#referenceMethod').on('click','.method-items',function(){
		var method = $(this).attr('data-method');
		$('.method-items').removeClass('-active');
		$(this).addClass('-active');
		$('#reference_method').val(method);
	});

	$('#referenceType').on('click','.type-items',function(){
		var type = $(this).attr('data-type');
		$('.type-items').removeClass('-active');
		$(this).addClass('-active');
		$('#reference_type').val(type);
	});

	$('#referenceCategory').on('click','.category-items',function(){
		var category = $(this).attr('data-id');
		$('.category-items').removeClass('-active');
		$(this).addClass('-active');
		$('#reference_category').val(category);
	});

	$('#reference').on('click','.btn-edit',function(e){

		var reference_id = $(this).parent().attr('data-id');

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"GET",
	        data:{
	            request 	:'get',
	            reference_id:reference_id,
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	        }
	    }).done(function(data){
	    	console.log(data);

	    	$('#reference_id').val(data.dataset.id);
	    	$('#reference_name').val(data.dataset.name);
	    	$('#reference_description').val(data.dataset.description);
	    	$('#reference_method').val(data.dataset.method);
	    	$('#reference_category').val(data.dataset.category_id);
	    	$('#reference_type').val(data.dataset.type);

	    	$('#method-items-'+data.dataset.method).addClass('-active');
	    	$('#type-items-'+data.dataset.type).addClass('-active');
	    	$('#category-items-'+data.dataset.category_id).addClass('-active');

	    	$createReferenceDialog.fadeIn(100);
	    	$btnDeleteReference.fadeIn(100);
	    	$createDialogFilter.fadeIn(300);
	    });
	});

	$btnSubmitCreateReference.click(function(){
		
		console.log('btnSubmitCreateReference');

		var reference_id 		= $('#reference_id').val();
		var reference_category 	= $('#reference_category').val();
		var reference_name 		= $('#reference_name').val();
		var reference_description = $('#reference_description').val();
		var reference_method 	= $('#reference_method').val();
		var reference_type 		= $('#reference_type').val();

		if(reference_name == '' || reference_method == '' || reference_type == '') return false;

		console.log(reference_name,reference_method,reference_type);

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'submit',
	            reference_id		:reference_id,
	            reference_category	:reference_category,
	            reference_name		:reference_name,
	            reference_description:reference_description,
	            reference_method	:reference_method,
	            reference_type		:reference_type,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	        }
	    }).done(function(data){
	    	console.log(data);
	    	location.reload();
	    });
	});

	$btnDeleteReference.click(function(){
		var reference_id 		= $('#reference_id').val();
		var reference_name 		= $('#reference_name').val();


		if(reference_id == '') return false;
		if(!confirm('Are you sure to delete "'+reference_name+'"?')){ return false; }

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'delete',
	            reference_id:reference_id,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	        }
	    }).done(function(data){
	    	console.log(data);
	    	$('#reference'+reference_id).remove();
	    	closeDialog();
	    });
	});
});