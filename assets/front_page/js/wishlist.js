jQuery(document).ready(function($) {
$(window).load(function() {

		/*================================================
			2.	SEARCH BUTTON
		================================================*/
		$(".wishlist").click(function(event){
			
			event.preventDefault(); 

			$("#productSummary").modal('toggle');
			$("#loadingModalCart").show();
			$("#responseCart").hide();
			$(".modal-title").show();
			$(".modal-title").html("Please Wait");
			
			var base_url 				= $('#base_url').val();
			var product_id				= $(this).attr('id');
			var wishlist_ajax_url 		= base_url + 'ajax/add_wishlist'; 
			var postData				= {};
				postData['product_id'] 	= product_id;

				$.post(wishlist_ajax_url,postData, function(data) {
				}).done(function(data){
					
					$("#loadingModalCart").hide();
					$("#responseCart").html('<div class="alert alert-success"><strong>Wishlist Sudah Ditambahkan</strong></div><div class="row"><div class="col-md-4 col-md-offset-4"><a href="#" data-dismiss="modal" class="btn btn-block btn-lg btn-info"><strong>CLOSE</strong></a></div></div>');
					$("#responseCart").show();
					$(".modal-header").hide();
					
					//$("#search_result #search_content").html(data);
				}).fail(function(){

					$("#loadingModalCart").hide();
					$("#responseCart").html('<div class="alert alert-success"><a href="'+base_url+'login">Silahkan Login Dulu</a></div><div class="row"><div class="col-md-4 col-md-offset-4"><a href="#" data-dismiss="modal" class="btn btn-block btn-lg btn-info"><strong>CLOSE</strong></a></div></div>');
					$("#responseCart").show();
					$(".modal-header").hide();

				}).always(function(){

				});
		});

		

}); // $(window).load(function() { 
});	