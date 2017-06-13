<div id="main-container" class="container">
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Payment Information
		</h2>
		<?php $this->load->view('main/field/message_info'); ?>
	<!-- Main Heading Ends -->
<!-- Shipment Information Block Starts -->
		<section class="registration-area">
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
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url()?>payment/confirm_process" enctype="multipart/form-data">
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Shipping Address :</label>
									<div class="col-sm-8">
										<?php echo $address->row()->alamat_lengkap?>
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Choose Bank :</label>
									<div class="col-sm-8">
										<input type="hidden" name="order_id" value="<?php echo $order_id?>">
										<select class="form-control" name="bank" required>
											<option value="">-- Choose Bank --</option>
											<?php foreach($bank->result() as $row){?>
												<?php 
													$selected = '';
													if( 	$this->session->has_userdata('customer_bank')  
														&&	$this->session->userdata('customer_bank') ==  $row->bank_id
													){
														$selected = 'selected="selected"';
													}
												?>
											<option value="<?php echo $row->bank_id?>" <?php echo $selected ?>>
												<?php echo strtoupper($row->nama_bank)?> - <?php echo $row->no_rekening?> a/n <?php echo $row->nama_pemilik_rekening?> ></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Your Account Name :</label>
									<div class="col-sm-8">
										<?php 
											$customer_account_name = '';
											if( $this->session->has_userdata('customer_account_name')  ){
												$customer_account_name = $this->session->userdata('customer_account_name');
											}
										?>
										<input type="text" name="name" class="form-control" value="<?php echo $customer_account_name ?>"required /> 
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Transfer Amount :</label>
									<div class="col-sm-8">
										<?php 
											$customer_amount_transfer = '';
											if( $this->session->has_userdata('customer_amount_transfer') ){
												$customer_amount_transfer = $this->session->userdata('customer_amount_transfer');
											}
										?>
										<input type="number" name="transfer_amount" class="form-control" value="<?php echo $customer_amount_transfer ?>"required /> 
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Transfer Receipt :</label>
									<div class="col-sm-8">
										<input type="file" name="transfer_receipt" class="form-control" required>
									</div>
									
								</div>
								
								<hr>
								
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-default">Confirm Payment</button>
									</div>
								</div>
							
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
				<!-- Total Panel Ends -->
				</div>
			
			<!-- Shipping & Shipment Block Ends -->
			
			</div>
			
		</section>
		
	</div>	