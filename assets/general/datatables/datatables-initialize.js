jQuery(document).ready(function() {  
//$(window).load(function() {


    /*==========================================
        1.  DATA TABLE
    ==========================================*/
    var all_id = ".datatables";
        
        //$(all_id).dataTable();
        $(all_id).DataTable( {
            responsive: true,
            lengthMenu: [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            pageLength: 2
        });


    $('.datatables_normal_table').DataTable( {
        responsive: true,
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    });
//});
});