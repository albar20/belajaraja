$( document ).ready(function() {
	$('#bs-datepicker-component').datepicker();
});	

function terimaKasih(id)
{
	$.ajax({
		url : baseurl+'review/terimakasih',
		type: "post",
		data: "tour_id="+id,
		beforeSend: function()
		{
			$("#btn-like-"+id).button('loading');
		},
		success: function(r)
		{
			$("#btn-like-"+id).hide();
			$("#jumlahsuka"+id).html(r);
			$("#commentText"+id).append('<button class="button-sudah-terimakasih">Anda Menyukai Review Ini</button>');
		}
	});
}

function ambil_kota(id)
{
	$.ajax({
		type	: "post",
		url		: baseurl+"rekomendasi/ambil_kota/"+id,
		success : function(res)
		{
			$("#city").html(res);
		}
	})
}