
function show_user(){
	$.ajax({
		type : "POST",
		url : baseurl + "user/show_user",
		success : function(res){
			$(".info-table").html(res);
		}
	})
}

	$(document).ready(function() {

// $(".navigation-menu").hide();
  $(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
      // $("p").addClass("test");
      $(".navigation-menu").hide();
    } else {
    	 $(".navigation-menu").show();
      // $("p").removeClass("test");
    }
  });

$("#provinsi").hide();
$("#desa").hide();
$("#kota").hide();

$("#cari").change(function(event) {
	if ($("#cari").val() == 'kota') {
		
		$("#kota").show();
		$("#provinsi").show();
		$("#desa").hide();
	}
	if ($("#cari").val() == 'provinsi') {
		$("#kota").hide();       
		$("#provinsi").show();
		$("#desa").hide();
	}
});

		$("#provinsi").change(function(event) {
			$.ajax({
				type : "POST",
				url : baseurl + "tour/show_provinsi",
				data : "id_provinsi=" + $("#provinsi").val(),
				success : function(res){
					$("#kota").html(res);
				} 

			})
		});

		$("#kota").change(function(event) {
			//alert($("#kota").val());
			$.ajax({
			type : "POST",
			url : baseurl + "tour/show_desa",
			data : "id_kota=" + $("#kota").val(),
			success : function(res){
				$("#desa").html(res);
			} 
		});
		});

		show_user();
		$("#save_user").hide();
		$(".update-table").hide();
		$(".update_user").click(function()	{
				//alert($(this).attr("shoes-id"));
				
				$.ajax({
					type:'POST',
					url : baseurl + 'user/update_user',
					dataType: "json",
					success: function(res)	{
						$("#update_user").hide();
						$("#save_user").show();
						$(".update-table").show();
						  $(".info-table").hide();
						  $("#phone").val(res.phone);
						  $("#address").val(res.address);
						  $("#site").val(res.site);
						  $("#birthday").val(res.birthday);
						  $("#gender").val(res.gender);
						  //$('input[name=address]').val('tes'); //cara memanggil berdasarkan name
						//$("#totalqty").html("<strong>" + resdata + "&nbsp;items</strong>");

					}
				});
			});

		$("#save_user").click(function(event) {
			$.ajax({
				type : "POST",
				url :  baseurl + "user/do_update_user",
				data : "phone=" + $("#phone").val() + "&address=" + $("#address").val() 
						+ "&site=" + $("#site").val() + "&birthday=" + $("#birthday").val()
						+ "&gender=" + $("#gender").val(),
				success : function(){
					$("#update_user").show();
						$("#save_user").hide();
					$(".update-table").hide();
						  $(".info-table").show();
						  show_user();
				}
			})
		});


$(".page_user").click(function(event) {
	 // var link =  $(this).attr('link');
	 // alert(link);
	 $.ajax({
	 	type : "POST",
	 	url : baseurl + "user/paging",
	 	data : "link=" + $(this).attr('link'),
	 	success : function(res){
	 		$(".paging_user").html(res);
	 	}	
	 })
});

$(".link-review").click(function(event) {
	var link = $(this).attr('link');
	$.ajax({
		type : "POST",
		url : baseurl + "review/paging_review",
		data : "link=" + $(this).attr('link'),
		success : function(res){
			var links = "#link" + link; 
			// $(link).addClass('tes');
			$(links).addClass('active');
			$(".paging-review").html(res);
		}
	})
});



	});