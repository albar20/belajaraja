<div class="main-container container">
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Shipping Information
		</h2>
		
		<?php $this->load->view('main/field/message_info'); ?>
<!-- Shipment Information Block Starts -->
		<section class="registration-area">
			<div class="row">
				<div class="col-sm-6">
				
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Shipment Information
							</h3>
						</div>
						<div class="alert-danger-address-info" style="display:none;">
							<strong><i class="fa fa-exclamation"><span id="errorAddressMessage"></span></i></strong>
						</div>
						
						<div class="panel-body">
						<!-- Form Starts -->
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url()?>cart/saving_order">
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Choose Address :</label>
									<div class="col-sm-5">
										<select class="form-control" id="listCustomerAddress" name="address" onchange="getShippingFee(this.value)" required>
											<option value="">-- Choose Address --</option>
											<?php foreach($listaddress->result() as $row){?>	
												<option value="<?php echo $row->customer_address_id?>"><?php echo $row->nama_penerima.' '.$row->alamat_lengkap?></option>
											<?php } ?>	
										</select>
									</div>
									
									<div class="col-sm-1">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormAddress">
										  Add
										</button>
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputFname" class="col-sm-4 control-label">Choose Courier :</label>
									<div class="col-sm-5">
										<select class="form-control" name="courier" id="listCourier" onchange="chooseCourier(this.value)" required>
											<option value="">-- Choose Courier --</option>
										</select>
									</div>
									
									<div class="col-sm-1" id="loadingKurir" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading">
										
									</div>
									
								</div>
								
								<hr>
								
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-black">Go To Payment</button>
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
								$discount		= 0;
								foreach($this->cart->contents() as $item){ 
									$discount		= $discount + $item['discount'];
								
							?>	
								<dt><?php echo $item['name']?> :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($item['subtotal'])?> (<?php echo $item['qty']?>)</dd>
							<?php } ?>
							<hr>
								<dt>Total :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($this->cart->total())?></dd>
								<dt>Coupon Discount :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($discount) ?></dd>
								<dt>Shipping :</dt>
								<dd id="shippingPrice"></dd>
							</dl>
							<hr>
							<dl class="dl-horizontal total">
								<dt>Total (Net):</dt>
								<dd id="totalShipping">Rp. <?php echo($this->cart->format_number($this->cart->total() - $discount))?></dd>
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
	
<div id="modalFormAddress" class="modal fade" data-backdrop="false" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Address</h4>
      </div>
      <div class="modal-body">
	  
		<div class="alert alert-danger" id="errorFormAddress" style="display:none;">
		  Please fill all form input.
		</div>
	  
		<form class="form-horizontal" role="form" id="formAddress">
			<div class="form-group" id="fname">
				<label for="inputFname" class="col-sm-3 control-label">Name :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="name" placeholder="Full Name">
				</div>
			</div>
			
			<div class="form-group" id="phone">
				<label for="inputPhone" class="col-sm-3 control-label">Phone :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="phone" placeholder="Phone">
				</div>
			</div>
			<div class="form-group" id="address">
				<label for="inputAddress1" class="col-sm-3 control-label">Address :</label>
				<div class="col-sm-6">
					<textarea class="form-control" name="address" placeholder="Address"></textarea>
				</div>
			</div>
			<div class="form-group" id="province">
				<label for="inputCountry" class="col-sm-3 control-label">Province :</label>
				<div class="col-sm-6">
					<select class="form-control" name="province" onclick="getCity(this.value)" required>
						<option value="">- Choose Province -</option>
						<?php foreach($province as $row){?>
						<option value="<?php echo $row['province_id']?>"><?php echo $row['province']?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group" id="city">
				<label for="inputRegion" class="col-sm-3 control-label">City :</label>
				<div class="col-sm-6">
					<select class="form-control" name="city" id="listCity" required>
						<option value="">- Choose City -</option>
					</select>
				</div>
			</div>
			
			<div class="form-group" id="postcode">
				<label for="inputPostCode" class="col-sm-3 control-label">Postal Code :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="postcode" placeholder="Postal Code">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="button" class="btn btn-black" id="buttonAddAddress" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving Address" onclick="saveAddress()">Save</button>
				</div>
			</div>
		</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>	