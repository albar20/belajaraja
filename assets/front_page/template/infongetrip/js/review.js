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
			$("#btn-like-"+id).button('reset');
			$("#jumlahsuka"+id).html(r);
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