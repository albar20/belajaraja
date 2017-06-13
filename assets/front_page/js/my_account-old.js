/*================================================
	1.	$("#show_tambah_alamat_form")
	2.	$(".cancel_tambah_alamat")
	3.	$(".ubah_alamat_baru_button")
	4.	$(".pengiriman_id")
================================================*/


jQuery(document).ready(function($) {
$(window).load(function() {

	/*================================================
		1.	$("#show_tambah_alamat_form")
	================================================*/
	$("#show_tambah_alamat_form").click(function(event){
		event.preventDefault(); 
		$('.tambah_alamat_form').css('display','block');
	});

	/*================================================
		2.	$(".cancel_tambah_alamat")
	================================================*/
	$(".cancel_tambah_alamat").click(function(event){
		$('.tambah_alamat_form').css('display','none');
	});	

	/*================================================
		3.	$(".ubah_alamat_baru_button")
	================================================*/
	$(".ubah_alamat_baru_button").click(function(event){
		var customer_address_id = $(this).attr('id');
		
		//$('.tambah_alamat_form form .customer_address_id').remove();	
		$('.tambah_alamat_form form .customer_address_id').val(customer_address_id);	

			base_url 					= $('#base_url').val();
			get_customer_data_url 		= base_url + 'my_account/get_customer_address_data'; 
			
		var postData							= {};
			postData['customer_address_id'] 	=  customer_address_id;

			$.post( get_customer_data_url,postData, function(data) {
				//alert( data);
			}).done(function(data){
				//alert( data);
				var customer_address = jQuery.parseJSON(data); // OBJECT
				$.each(customer_address, function(property, value) {
					$.each(value, function(property, value) {
						//alert(property + "=" + value);		  
						$('.tambah_alamat_form #'+property).val(value);
					});
				});
				$('.tambah_alamat_form').css('display','block');
			}).fail(function(){
				alert('coba lagi');
			}).always(function(){

			});
	});	


	/*================================================
		4.	$(".pengiriman_id")
	================================================*/
	$(".pengiriman_id").click(function(event){
		
		$(".pengiriman_id").each(function(){
      		$(this).removeAttr( "checked" );
    	});

		$(this).attr("checked", "checked");
		
		var customer_address_id = $(this).val();

			base_url 						= $('#base_url').val();
			set_alamat_baru_url 			= base_url + 'my_account/set_default_customer_address'; 
		var postData						= {};
			postData['customer_address_id'] =  customer_address_id;
		
			$.post(set_alamat_baru_url,postData, function(data) {
				//alert( data);
			}).done(function(data){
				
			}).fail(function(){
				alert('coba lagi');
			}).always(function(){

			});

	});


}); // $(window).load(function() { 
});	