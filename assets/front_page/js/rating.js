$(document).ready(function() {	
	$("#rateOverall").rateYo({
		rating    : $("#nilaiRating").val()
	}).on("rateyo.set", function (e, data) {		
		$("#nilaiRating").val(data.rating);
	});
});	