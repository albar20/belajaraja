<?php 
/*========================================================
    1.  BREADCRUMB
    2.  CONTENT

========================================================*/ ?>    
<div id="content-wrapper">
    <?php 
    /*========================================================
        1.  BREADCRUMB
    ========================================================*/ ?>   
    <?php $this->load->view('library/breadcrumb/breadcrumb_custom'); ?>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-gear page-header-icon"></i>&nbsp;&nbsp;Log Pengunjung</h1>
            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h">
                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->
    
    <?php 
    /*========================================================
        2.  CONTENT
    ========================================================*/ ?>   
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('library/log/log_visitor_admin'); ?>
        </div>
    </div>     


</div> <!-- / #content-wrapper -->