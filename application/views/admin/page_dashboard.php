<?php 

/*=======================================================

    1.  CHART

        1.  DATE FILTER

        2.  TOTAL ORDER & TOTAL CUSTOMER

    2.  OVERVIEW 

        1.  total sales                                                                                

        2.  total sales this year                                                                      

        3.  total orders                                                                               

        4.  total payments                                                                             

        5.  Numbers of Customers                                                                       

        6.  Customers Awaiting Approval                                                      

        7.  Reviews Awaiting Approval                                                                  

        8.  Latest Order              

    3.  LATEST ORDER

=======================================================*/?>

<div id="content-wrapper">

        <ul class="breadcrumb breadcrumb-page">

            <div class="breadcrumb-label text-light-gray">You are here: </div>

            <li><a href="#">Home</a></li>

            <li class="active"><a href="#">Dashboard</a></li>

        </ul>

        <div class="page-header">

            

            <div class="row">

                <!-- Page header, center on small screens -->

                <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>





                <div class="col-xs-12 col-sm-8">

                    <div class="row">

                        <hr class="visible-xs no-grid-gutter-h">

                        <!-- "Create project" button, width=auto on desktops -->

                        <!-- <div class="pull-right col-xs-12 col-sm-auto"><a href="#" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Create project</a></div> -->



                        <!-- Margin -->

                        <!-- <div class="visible-xs clearfix form-group-margin"></div> -->



                        <!-- Search field -->

                        <!-- <form action="#" class="pull-right col-xs-12 col-sm-6"> -->

                            <!-- <div class="input-group no-margin"> -->

                                <!-- <span class="input-group-addon" style="border:none;background: #fff;background: rgba(0,0,0,.05);"><i class="fa fa-search"></i></span> -->

                                <!-- <input type="text" placeholder="Search..." class="form-control no-padding-hr" style="border:none;background: #fff;background: rgba(0,0,0,.05);"> -->

                            <!-- </div> -->

                        <!-- </form> -->

                    </div>

                </div>

            </div>

        </div> <!-- / .page-header -->



        <div class="row">

            <div class="col-md-12">

            

                



<!-- 5. $UPLOADS_CHART =============================================================================



                Uploads chart

-->

                <!-- Javascript -->

                <?php 

                /*=======================================================

                    1.  CHART

                        1.  DATE FILTER

                        2.  TOTAL ORDER & TOTAL CUSTOMER

                =======================================================*/?>

                

                <?php 

                /*=======================================================

                    1.  DATE FILTER

                =======================================================*/?>

                <form action="" method="post">

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_birthday') != '') { echo 'has-error'; } ?>">

                    <div class="row">

                        <label class="col-sm-2 control-label">Tanggal Order Mulai</label>

                        <div class="col-sm-3">

                            <input  type="text"

                                    id="boostrap_date_picker" 

                                    class="form-control tanggal_order_mulai" 

                                    name="tanggal_order_mulai"

                                    value="<?php echo set_value('tanggal_order_mulai', isset($default['tanggal_order_mulai']) ? $default['tanggal_order_mulai'] : ''); ?>" /> 

                            <?php echo form_error('tanggal_order_mulai', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>         

                        </div>

                        <label class="col-sm-2 control-label">Tanggal Order Akhir</label>

                        <div class="col-sm-3">

                            <input  type="text"

                                    id="boostrap_date_picker" 

                                    class="form-control tanggal_order_akhir" 

                                    name="tanggal_order_akhir"

                                    value="<?php echo set_value('tanggal_order_akhir', isset($default['tanggal_order_akhir']) ? $default['tanggal_order_akhir'] : ''); ?>" />   

                            <?php echo form_error('tanggal_order_akhir', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>         

                        </div>

                        <div class="col-sm-2">

                            <button class="btn btn-primary" type="submit">Filter</button>   

                        </div>

                    </div>

                </div>

                </form>

                

            

                <?php 

                /*=======================================================

                    2.  TOTAL ORDER & TOTAL CUSTOMER

                =======================================================*/?>

                <script>

                    

                    init.push(function () {

                        <?php 

                            if(     $display_chart_format == 'month'

                                ||  $display_chart_format == 'day' ):

                        ?>

                        //alert('bn');

                        var uploads_data = [

                            <?php if( count($total_order_by_dates) > 0) : ?>

                            <?php foreach($total_order_by_dates as $date => $row ) : ?>

	                            { <?php echo $display_chart_format ?>: '<?php echo $date; ?>', v: <?php echo $row['total_order']?>, u: <?php echo count($row['customer_id']) ?> },



                            <?php endforeach; ?>

                            <?php endif; ?>

                        ];

                        Morris.Line({

                            element: 'hero-graph',

                            data: uploads_data,

                            xkey: '<?php echo $display_chart_format ?>',

                            ykeys: ['v','u'],

                            labels: ['Total Order','Total Customer'],

                            lineColors: ['#fff','yellow'],

                            lineWidth: 2,

                            pointSize: 4,

                            gridLineColor: 'rgba(255,255,255,.5)',

                            resize: true,

                            smooth: 'false',

                            gridTextColor: '#fff',

                            xLabels: "<?php echo $display_chart_format ?>",

                            xLabelFormat: function(d) {

                                return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate(); 

                            },

                        });

                        <?php endif; ?>                      



                        <?php if( $display_chart_format == 'year' ): ?>

                        <?php 

                            $years = '';

                            $yearnum = 1;

                            foreach($total_order_by_dates as $year => $cus ){

                                $separator = ',';

                                if( $yearnum == count($total_order_by_dates) ){

                                    $separator = ''; 

                                }     

                                $years .= "{ year: '".$year."', t: ".$cus['total_order'].", v: ".count($cus['customer_id'])."}".$separator;

                                $yearnum++;

                            }

                        ?>

                         //alert('year');

                        new Morris.Line({

                            element: 'hero-graph',  // ID of the element in which to draw the chart.

                            data: [

                                <?php echo $years ?>

                                //{ year: '2008', value: 20 },{ year: '2009', value: 10 },{ year: '2010', value: 5 },{ year: '2011', value: 5 },{ year: '2012', value: 20 }

                            ],

                            ykeys: ['t','v'],

                            labels: ['Total Order','Total Customer'],

                            xkey: 'year',

                            smooth: 'false',

                            xLabels: "year",

                            lineColors: ['#fff','yellow'],

                            gridTextColor: '#fff',

                            xLabels: "<?php echo $display_chart_format ?>",

                            

                        });  

                        <?php endif; ?>  



                        <?php if( $display_chart_format == 'hour' ): ?>

                        //alert('hour');

                        <?php 

                            $hours = '';

                            $yearnum = 1;

                            foreach($total_order_by_dates as $year => $cus ){

                                $separator = ',';

                                if( $yearnum == count($total_order_by_dates) ){

                                    $separator = ''; 

                                }     

                                $hours .= "{ hour: '".$year."', t: ".$cus['total_order'].", v: ".count($cus['customer_id'])."}".$separator;

                                $yearnum++;

                            }

                        ?>

                        new Morris.Line({

                            element: 'hero-graph',  // ID of the element in which to draw the chart.

                            data: [

                                <?php echo $hours ?>

                            ],

                            ykeys: ['t','v'],

                            labels: ['Total Order','Total Customer'],

                            xkey: 'hour',

                            smooth: 'false',

                            xLabels: "year",

                            lineColors: ['#fff','yellow'],

                            gridTextColor: '#fff',

                            xLabels: "<?php echo $display_chart_format ?>",

                        });  

                        <?php endif; ?>  

                    });

                



                </script>

                <!-- / Javascript -->



                <div class="stat-panel">

                    <div class="stat-row">

                        

                        <!-- Primary background, small padding, vertically centered text -->

                        <div class="stat-cell col-sm-12 bg-primary padding-sm valign-middle">

                            <div id="hero-graph" class="graph" style="height: 253px;"></div>

                        </div>

                    </div>

                </div> <!-- /.stat-panel -->

<!-- /5. $UPLOADS_CHART -->



            </div>

        </div>



        <!-- Page wide horizontal line -->

        <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">



        <div class="row">

<!-- 12. $NEW_USERS_TABLE ==========================================================================



            New users table

-->

            <?php 

            /*=======================================================

                2.  OVERVIEW 

            =======================================================*/?>

            <div class="col-md-12">

                <div class="panel panel-dark panel-light-green">

                    <div class="panel-heading">

                        <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>OVERVIEW</span>

                        <div class="panel-heading-controls">

                            <!-- <ul class="pagination pagination-xs">

                                <li><a href="#">«</a></li>

                                <li class="active"><a href="#">1</a></li>

                                <li><a href="#">2</a></li>

                                <li><a href="#">3</a></li>

                                <li><a href="#">»</a></li>

                            </ul> --> <!-- / .pagination -->

                        </div> <!-- / .panel-heading-controls -->

                    </div> <!-- / .panel-heading -->

                    

                    <table class="table table-overview">

                        <thead>

                            <!-- <tr>

                                <th>No.</th>

                                <th>Nama Lengkap</th>

                                <th>Username</th>

                                <th>Status</th>

                            </tr> -->

                        </thead>

                        <tbody class="valign-middle">

                            <tr>

                                <td>Total Sales</td>


                            </tr>   

                            <tr>

                                <td>Total Sales this year</td>





                            </tr>    

                            <tr>

                                <td>Total Payments</td>


                            </tr>    

                            <tr>

                                <td>Total Customers</td>

                                <?php if( count($total_customers->result()) > 0): ?>

                                    <?php $tc = $total_customers->result(); ?>

                                    <td><?php echo $tc[0]->total_customers ?></td>

                                <?php endif; ?>

                            </tr>    

                            <tr>

                                <td class="color_yellow">Total Unconfirmation Register Customers</td>

                                <?php if( count($total_customers_waitin_approval->result()) > 0): ?>

                                    <?php $tcw = $total_customers_waitin_approval->result(); ?>

                                    <td class="color_yellow"><?php echo $tcw[0]->total_customers ?></td>

                                <?php endif; ?>

                            </tr> 

                            <tr>

                                <td>Total Order</td>



                            </tr> 



                            <tr>

                                <td class="color_red">Total Order Waiting Approval</td>

                                <td class="color_red"><?php //echo $this->total_order_waiting_approval; ?></td>

                            </tr>  

                        </tbody>

                    </table>

                </div> <!-- / .panel -->

            </div>





            <?php 

            /*=======================================================

                3.  LATEST ORDER

            =======================================================*/?>   

            <div class="col-md-12">

                <div class="panel panel-dark panel-light-green">

                    <div class="panel-heading">

                        <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>10 LATEST ORDER</span>

                        <div class="panel-heading-controls">

                            <!-- <ul class="pagination pagination-xs">

                                <li><a href="#">«</a></li>

                                <li class="active"><a href="#">1</a></li>

                                <li><a href="#">2</a></li>

                                <li><a href="#">3</a></li>

                                <li><a href="#">»</a></li>

                            </ul> --> <!-- / .pagination -->

                        </div> <!-- / .panel-heading-controls -->

                    </div> <!-- / .panel-heading -->

                    

                    <table class="table table-overview">

                        <thead>

                            <tr>

                                <th>No.</th>

                                <th>Date</th>

                                <th>Customer Name</th>

                                <th>Order Total</th>

                                <th>View</th>

                            </tr>

                        </thead>

                        <tbody class="valign-middle">

                            

                        </tbody>

                    </table>

                </div> <!-- / .panel -->

            </div>  



        </div>

    </div> <!-- / #content-wrapper -->

    <div id="main-menu-bg"></div>

</div> <!-- / #main-wrapper -->

<?php $this->load->view('admin/script_admin_below'); ?>