function getShippingCostOptions(city_id) {
	$.ajax({
		type: 'POST',
		url: '/orders/shipping-cost',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			city_id: city_id
		},
		success: function (response) {
			$('#shipping-cost-option').empty();
			$('#shipping-cost-option').append('<option value>- Pilih -</option>');

			$.each(response.results, function(key, result){
				$('#shipping-cost-option').append('<option value="'+ result.service.replace(/\s/g, '') +'">'+ result.service + ' | ' + result.cost + ' | ' + result.etd + '</option>');
			});
		}
	});
}

(function($) {
	
	// $('#user-province-id').on('change', function (e) {
	// 	var province_id = e.target.value;
 
	// 	$.get('/orders/cities?province_id=' + province_id, function(data){
	// 		$('#user-city-id').empty();
	// 		$('#user-city-id').append('<option value>- Pilih -</option>');

	// 		$.each(data.cities, function(city_id, city){
			  
	// 		   $('#user-city-id').append('<option value="'+city_id+'">'+ city + '</option>');

	// 	   });
	// 	});
	// });


	$('#province-id').on('change', function (e) {
		var province_id = e.target.value;
 
		$.get('/orders/cities?province_id=' + province_id, function(data){
			$('#city-id').empty();
			$('#city-id').append('<option value>- Pilih -</option>');

			$.each(data.cities, function(city_id, city){
			  
			   $('#city-id').append('<option value="'+city_id+'">'+ city + '</option>');

		   });
		});
	});

	$('#shipping-province').on('change', function (e) {
		var province_id = e.target.value;
 
		$.get('/orders/cities?province_id=' + province_id, function(data){
			$('#shipping-city').empty();
			$('#shipping-city').append('<option value>- Pilih -</option>');

			$.each(data.cities, function(city_id, city) {
			  
			   $('#shipping-city').append('<option value="'+city_id+'">'+ city + '</option>');

		   });
		});
	});

	// ======= Show Shipping Cost Options =========
	if ($('#city-id').val()) {
		getShippingCostOptions($('#city-id').val());
	}

	$('#city-id').on('change', function (e) {
		var city_id = e.target.value;

		if (!$('#ship-box').is(':checked')) {
			getShippingCostOptions(city_id);
		}
	});

	$('#shipping-city').on('change', function (e) {
		var city_id = e.target.value;
		getShippingCostOptions(city_id);
	});

	// ============ Set Shipping Cost ================
	$('#shipping-cost-option').on('change', function (e) {
		var shipping_service = e.target.value;
		var city_id = $('#city-id').val();
		
		if ($('#ship-box').is(':checked')) {
			city_id = $('#shipping-city').val();
		}

		$.ajax({
			type: 'POST',
			url: '/orders/set-shipping',
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				city_id: city_id,
				shipping_service: shipping_service
			},
			success: function (response) {
				$('.total-amount').html(response.data.total);
			}
		});
	});


	// ============ Product fav ================
	$('.add-to-fav').on('click', function (e) {
		e.preventDefault();

		var product_slug = $(this).attr('product-slug');

		$.ajax({
			type: 'POST',
			url: '/favorites',
			data:{
				_token: $('meta[name="csrf-token"]').attr('content'),
				product_slug: product_slug
			},
			success: function (response) {
				alert(response);
			},
			error: function (xhr, textStatus, errorThrown) {
				if (xhr.status == 401) {
					$('#loginModal').modal();
				}
			
				if (xhr.status == 422) {
					alert(xhr.responseText);
				}
			}
		});
	});

})(jQuery);

// read more description
function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Lihat Selengkapnya";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Lihat Lebih Sedikit";
        moreText.style.display = "inline";
    }
}

// product fav

