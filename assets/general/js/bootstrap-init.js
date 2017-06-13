/*===============================================================================================================
	1.	HELPER FUNCTIONS
		1.	GET DAYS IN MONTH

	

	2.	INITIALIZE DATE PICKER
		1.	GENERAL
		1.	#date_for_chat_premium		( on member/dashboard_activity_master/premium_question) => chat

===============================================================================================================*/	
	
	/*===============================================================================================================
		1.	HELPER FUNCTIONS
			1.	GET DAYS IN MONTHS
	===============================================================================================================*/	

		/*===============================================================================================================
			1.	GET DAYS IN MONTHS
		===============================================================================================================*/
		function getDaysInMonth(month, year) {
		    
			var date = new Date(year, month, 1);
		    var days = [];
		    
		    while (date.getMonth() == month) {
		        var day 		= date.getDate() + '';
		     		day 		= day.length == 1 ? '0'+ day : day;
		      	var months 		= date.getMonth() + '';
		     		months 		= months.length == 1 ? '0'+months : months;
		    	var years 		= date.getFullYear();
		     		years  		= years .length == 1 ? '0'+years  : years ; 	 
		  		
		  		days.push(day+'-'+months+'-'+years);
		       	//days.push(new Date(date));
		        date.setDate(date.getDate() + 1);
		     }
		     return days;
		}


jQuery(document).ready(function($) {
$(window).load(function() {
	

	/*=============================================
		2.	INITIALIZE DATE PICKER
			1.	GENERAL
			1.	#date_for_chat_premium	
	=============================================*/

		/*=============================================
			1.	GENERAL
		=============================================*/	
		$('#boostrap_date_picker,#tanggal_mulai_kupon,#tanggal_akhir_kupon').datepicker({
			format: "dd-mm-yyyy"
		});

		/*=============================================
			1.	#date_for_chat_premium	
				1.	SET UNAVAILABLE DATE
					1.	DATE
					2.	MONTH
					3.	DAY
				2.	DATE PICKER INITIALIZE
		=============================================*/	
		if( $('#date_for_chat_premium').length > 0 ){

			/*=============================================
				1.	SET UNAVAILABLE DATE
					1.	DATE
					2.	MONTH
					3.	DAY
			=============================================*/			
				
				/*=============================================
					1.	DATE
				=============================================*/			
				var unavailable_date 	= $('#consultant_unavailable_on_date').val().split(',');


				/*=============================================
					2.	MONTH
				=============================================*/	
				var unavailable_month 	= $('#consultant_unavailable_on_month').val().split(',');

					$.each(unavailable_month, function (index, month) {
						
						var year = new Date();
							year = year.getFullYear();
						var days_in_month = getDaysInMonth(month,year);
						unavailable_date = $.merge( unavailable_date, days_in_month);
					});



				/*=============================================
					3.	DAY
				=============================================*/
				var unavailable_day 	= $('#consultant_unavailable_on_day').val();
					unavailable_day 	= unavailable_day.replace('monday','1');
					unavailable_day 	= unavailable_day.replace('tuesday','2');
					unavailable_day 	= unavailable_day.replace('wednesday','3');
					unavailable_day 	= unavailable_day.replace('thursday','4');
					unavailable_day 	= unavailable_day.replace('friday','5');
					unavailable_day 	= unavailable_day.replace('saturday','6');
					unavailable_day 	= unavailable_day.replace('sunday','0');
					unavailable_day 	= unavailable_day.split(',');
			

			/*=============================================
				2.	DATE PICKER INITIALIZE
			=============================================*/					
			$('#date_for_chat_premium').datepicker({
				format: "dd-mm-yyyy",
				datesDisabled:unavailable_date,
				daysOfWeekDisabled:unavailable_day
			});
			//$('#date_for_chat_premium').datepicker();
		}




});  
});	