//MAGNIFIC POPUP
$(document).ready(function() {	
	$("#rateOverall").rateYo({
		rating    : $("#nilaiRating").val()
	}).on("rateyo.set", function (e, data) {		
		$("#nilaiRating").val(data.rating);
	});
	
	$("#ratePrice").rateYo({
		rating    : $("#priceRating").val()
	}).on("rateyo.set", function (e, data) {		
		$("#priceRating").val(data.rating);
	});
	
	$("#ratePackaging").rateYo({
		rating    : $("#packagingRating").val()
	}).on("rateyo.set", function (e, data) {		
		$("#packagingRating").val(data.rating);
	});
	
	$("#rateproduct").rateYo({
		rating: $("#nilaiRating").val(),
		readOnly: true	
	});
	
	$("#input-quantity").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

  $('.images-block').magnificPopup({
    delegate: 'a', 
    type: 'image',
    gallery: {
      enabled: true
    }
  });

	$("#see_password").click(function (e) {
  		
if( $(this).prop( "checked" ) ){

  			$('#customer_password,#customer_password2').attr('type','text'); 
  		}else{
  			$('#customer_password,#customer_password2').attr('type','password'); 
  		}
  	});


});
(function($) {
	"use strict";
	// TOOLTIP	
	$(".header-links .fa, .tool-tip").tooltip({
	placement: "bottom"
	});
	$(".btn-wishlist, .btn-compare, .display .fa").tooltip('hide');
	// Product Owl Carousel
	if( $("#owl-product").length > 0 ){
		$("#owl-product").owlCarousel({
			autoPlay: false, //Set AutoPlay to 3 seconds
			items : 4,
			stopOnHover : true,
			navigation : true, // Show next and prev buttons
			pagination : false,
			navigationText : ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"]
		});
	}
  
	// TABS
	$('.nav-tabs a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
	});	
	
})(jQuery);

function addToCart(productId)
{
	var	qty 	= 1;
	var size	= "";
	
	$("#alert-size").hide();
	$("#alert-qty").hide();
	
	$("#qty-product").removeClass("has-error");
	$("#size-product").removeClass("has-error");
	
	if ( $( "#input-quantity" ).length ) {
		qty = $( "#input-quantity" ).val();
		if(qty == "" || qty <= 0)
		{
			$("#qty-product").addClass("has-error");
			$("#input-quantity").focus();
			$("#alert-qty").show();
			return false;
		}
	}
	
	if ( $( "#input-size" ).length ) {
		size = $( "#input-size" ).val();
		if(size == "")
		{
			$("#size-product").addClass("has-error");
			$("#alert-size").show();
			//$("#size").focus();
			return false;
		}
	}
	
	$.ajax({
		url			: baseurl+"cart/add_cart",
		type		: "post",
		data		: { product_id : productId, qty : qty, size : size },
		beforeSend	: function()
		{
			$("#productSummary").modal('toggle');
			$("#loadingModalCart").show();
			$("#responseCart").hide();
			$(".modal-title").show();
			$(".modal-title").html("Please Wait");
			//$(".modal-header").hide();
			//$(".modal-body").hide();
			//$(".modal-footer").hide();
		},
		success		: function(response)
		{
			$("#loadingModalCart").hide();
			$("#responseCart").html(response);
			$("#responseCart").show();
			$(".modal-header").hide();
			$("#qty-product").removeClass("has-error");
			$("#size-product").removeClass("has-error");
			$("#alert-size").hide();
			$("#alert-qty").hide();
			console.log(response);
		}
	});
}
function getCity(provinceId)
{
	$.ajax({
		url			: baseurl+"cart/get_city",
		type		: "post",
		data		: { province_id : provinceId },
		success		: function(response)
		{
			$("#listCity").html(response);
		}
	});
}
function saveAddress()
{
	var errorcount	= 0;
	var fields 		= $("#formAddress").serializeArray();
	
	//console.log(fields);
	//return 0;
	
    jQuery.each( fields, function( i, field ) {
      if(field.value == null || field.value == ""){
		$("#errorFormAddress").show();		
		$("#"+field.name).addClass("has-error");
		$("#"+field.name).focus();
		errorcount++;
	  }
	  else
	  {
		$("#"+field.name).removeClass("has-error");
	  }
    });
	
	if(errorcount > 0)
	{
		return false;
	}
	$.ajax({
		url			: baseurl+"cart/add_address",
		type		: "post",
		data		: $("#formAddress").serialize(),
		beforeSend	: function()
		{
			$("#buttonAddAddress").button('loading');
		},
		success		: function(response)
		{
			$("#listCustomerAddress").html(response);
			$("#buttonAddAddress").button('reset');
			jQuery.each( fields, function( i, field ) {
				$("#errorFormAddress").hide();		
				$("#"+field.name).removeClass("has-error");
				$("#"+field.name).removeAttr("value");
				$("#modalFormAddress").modal('toggle');
			});
		}
	});   
}
function  getShippingFee(address)
{
	if(address == null || address == "" || address == "undefined")
	{
		return false;
	}
	$.ajax({
		url			: baseurl+"cart/shipping_fee",
		type		: "post",
		data		: { address : address },
		beforeSend	: function()
		{
			$("#loadingKurir").button('loading');
			$("#alert-danger-address-info").hide();
		},
		success		: function(response)
		{
			$("#loadingKurir").button('reset');
			$("#listCourier").html(response.option);
			if(response.number_service == 0)
			{
				$("#alert-danger-address-info").show();
				$("#errorAddressMessage").html(response.warning);
			}	
		}
	});
}
function  chooseCourier(courier)
{
	if(courier == null || courier == "" || courier == "undefined")
	{
		return false;
	}
	
	var obj	= $.parseJSON(courier);
	$.ajax({
		url			: baseurl+"cart/get_total_cost",
		type		: "post",
		data		: { shipping_fee : obj.fee },
		beforeSend	: function()
		{
			$("#loadingTotalCost").button('loading');
			$("#totalShipping").hide();
		},
		success		: function(response)
		{
			$("#totalShipping").show();
			$("#shippingPrice").html(response.shipping_fee);
			$("#loadingTotalCost").button('reset');
			$("#totalShipping").html(response.total_cost);
		}
	}); 
}

function favourite(id)
{
	$.ajax({
		type : "POST",
		url	 : baseurl+"product/favourite",
		data : { review_id : id },
		beforeSend:function(){
			$(".btn").button('loading');
		},
		success:function(data){
			$("#jumlahReview"+id).html(data);
			$(".btn").button('reset');
		},
	});
}