/*================================================
	on, view/product.php
	1.	$("#sort_product")
	2.	$('.category-product')
================================================*/
jQuery(document).ready(function($) {
$(window).load(function() {


	/*================================================
		1.	$("#sort_product")
	================================================*/
	$("#sort_product,#show_total_product").change(function(){
		$( "#sort_form" ).submit();
	});

	/*================================================
		2.	$('.category-product')
	================================================*/
	$(".category-product").click(function(event){
		$(".sub-category-product").css('display','none');
		$(this).find('.sub-category-product').css('display','block');
	});




}); // $(window).load(function() { 
});	