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
	});