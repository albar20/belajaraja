<?php 
/*======================================================
    1.  ALAMAT
    2.  PRODUCTS
======================================================*/ ?>


<div id="content-wrapper" class="konfirmasi_pembayaran">

        <div class="page-header">
            <h1><?php echo strtoupper($heading)?></h1>
        </div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">

                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();
                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('konfirmasi Pembayaran');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">    
                        <br />
                        
                        <?php $this->load->view('admin/field/message_info'); ?>

                        <?php if($kofirmasi_pembayaran->num_rows() > 0) : $i=1;?>
                            <?php 
                            /*======================================================
                                2.  PRODUCTS
                            ======================================================*/ ?>
                            <div class="table-primary" id="tooltips-demo">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                    <thead>
                                        <tr>    
                                            <th colspan="3" class="center">Bank Info</th>
                                            <th colspan="5" class="center">Pembayaran Info</th>
                                        </tr>
                                        <tr>
                                            <th>Nama Bank</th>
                                            <th>No Rekening</th>
                                            <th>Nama Pemilik Rekening</th>
                                            <th>Tanggal Pembayaran</th>    
                                            <th>Nama Pengirim</th>
                                            <th>Tipe Pembayaran</th>
                                            <th>Bukti Transfer</th>
                                            <th>Jumlah Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($kofirmasi_pembayaran->result() as $row) :?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php echo $row->nama_bank; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->no_rekening; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->nama_pemilik_rekening; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->payment_date; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->nama_pengirim; ?>
                                            </td>
                                            <td>
                                                Transfer
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url() ?>uploads/bukti_pembayaran/<?php echo $row->bukti_transfer; ?>" width="200"/>
                                               
                                            </td>
                                            <td>
                                                <?php echo number_format($row->payment_amount); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <br/>
                                <?php if($row->order_status == 'confirm' ): ?>
                                    <div class="konfirmasi-button-wrap">
                                        <a class="btn btn-primary konfirmasi_button" href="<?php echo base_url() ?>admin/order/menyetujui_konfirmasi_pembayaran/<?php echo $row->order_id?>" >
                                            Menyetujui
                                        </a>

                                    </div>
                                    <br/>

                                    <div class="">
                                        <form action="<?php echo base_url() ?>admin/order/cancel_konfirmasi_pembayaran" method="post" >
                                            <input type="hidden" name="order_id" value="<?php echo $row->order_id?>"  />
                                            <input type="checkbox" name="rekening_salah" /> Rekening Salah
                                            <br/>
                                            <input type="checkbox" name="nominal_salah" /> Nominal Salah
                                            <br/>
                                            <br/>
                                            <input class="btn btn-primary konfirmasi_button" type="submit" value="Cancel" />
                                        </form>
                                    </div>
                                <?php endif; ?>
                                

                                <?php ?>
                            </div>

                        <?php endif;?>
                    </div>
                </div>
<!-- /11. $JQUERY_DATA_TABLES -->

            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>