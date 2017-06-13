<div class="main-container container">
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Payment Information
		</h2>
		<?php $this->load->view('main/field/message_info'); ?>
	<!-- Main Heading Ends -->
<!-- Shipment Information Block Starts -->
		<section class="registration-area page_transaction">
			<div class="row">
				<div class="col-sm-6">
				
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Confirm Payment
							</h3>
						</div>
						<div class="alert-danger-address-info" style="display:none;">
							<strong><i class="fa fa-exclamation"><span id="errorAddressMessage"></span></i></strong>
						</div>
						
						<div class="panel-body">
						<!-- Form Starts -->
							<form class="form-horizontal" role="form" >
								
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Shipping Address :</label>
									<div class="col-sm-8 bold">
										<?php echo $address->row()->alamat_lengkap?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Choose Bank :</label>
									<div class="col-sm-8 bold">
									
										<?php echo ($bank->num_rows() > 0 ? strtoupper($bank->row()->nama_bank) .' - '. $bank->row()->no_rekening .' a/n '. $bank->row()->nama_pemilik_rekening : "")?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Your Account Name :</label>
									<div class="col-sm-8 bold">
										<?php echo $payment->nama_pengirim?>
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Transfer Amount :</label>
									<div class="col-sm-8 bold">
										<?php echo "Rp. ". $this->cart->format_number($payment->payment_amount)?>
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Transfer Receipt :</label>
									<div class="col-sm-8">
										<img src="<?php echo base_url()?>uploads/bukti_pembayaran/thumb_<?php echo $payment->bukti_transfer?>" class="img img-responsive">
									</div>
									
								</div>
								
								<hr>
							
							</form>
							
						</div>
					</div>
				<!-- Shipment Information Block Ends -->
				</div>
				
				<div class="col-sm-6">
				<!-- Total Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Total Items In Cart
							</h3>
						</div>
						<div class="panel-body">
							<dl class="dl-horizontal">
							<?php
								foreach($order->result() as $item){ 
							?>	
								<dt><?php echo $item->product_name?> :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($item->price)?> (<?php echo $item->product_qty?>)</dd>
							<?php } ?>
							<hr>
								<dt>Total :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($order->row()->order_total)?></dd>
								<dt>Coupon Discount :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($order->row()->order_discount) ?></dd>
								<dt>Shipping :</dt>
								<dd id="shippingPrice">Rp. <?php echo $this->cart->format_number($order->row()->order_shipping_charge) ?></dd>
							</dl>
							<hr>
							<dl class="dl-horizontal total">
								<dt>Total (Net):</dt>
								<dd id="totalShipping">Rp. <?php echo($this->cart->format_number($order->row()->order_total - $order->row()->order_discount + $order->row()->order_shipping_charge))?></dd>
								<dd id="loadingTotalCost" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading"></dd>
							</dl>
						</div>
					</div>
					<br />
					<a href="<?php echo base_url() ?>my_order" class="btn btn-black">Back to My Order</a>
				<!-- Total Panel Ends -->
				</div>
			
			<!-- Shipping & Shipment Block Ends -->
			
			</div>
			
		</section>
		
	</div>	