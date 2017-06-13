jQuery(document).ready(function($) {
$(window).load(function() {

	/*================================================
		1.	SEARCH CONTENT
	================================================*/
	var search_result = '<div id="search_result">';
		search_result += '<div id="search_close" class="fa fa-times"></div>';
		search_result += '<div id="search_content"></div>';
		search_result += '</div>';
		$('body').append(search_result);


		/*================================================
			2.	SEARCH BUTTON
		================================================*/
		$("#search_button_blog,#search_button_top").click(function(event){
		
			event.preventDefault(); 

			var base_url	= $("#base_url").val();
			$("#search_result").css('display','block');
			$("#search_result #search_content").append( '<div id="preloader" style="position:absolute"></div>' );

			var keyword = '';
			if( $(this).attr('id') == 'search_button_blog' ){
				keyword 	= $("#search_blog_keyword").val();
			}
			if( $(this).attr('id') == 'search_button_top' ){
				keyword 	= $("#search_top_keyword").val();
			}


			var search_ajax_url 		= base_url + 'ajax/search'; 
			var postData				= {};
				postData['keyword'] 	= keyword;
				
				$.post(search_ajax_url,postData, function(data) {
					//alert( data);
				}).done(function(data){
					//alert( data );
					$("#search_result #search_content").html(data);
				}).fail(function(){
					alert('coba lagi');
				}).always(function(){

				});
		});

		/*================================================
			3.	SEARCH CLOSE
		================================================*/
		$("#search_close").click(function(event){
			$("#search_result").css('display','none');
		});

		

}); // $(window).load(function() { 
});	