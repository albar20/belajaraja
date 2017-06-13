
	<!-- Main Container Starts -->
	<div id="main-container" class="container">
		<!-- Breadcrumb Starts -->
		<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
		<!-- Breadcrumb Ends -->

		<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Shopping Cart
		</h2>
		<!-- Main Heading Ends -->
		<?php $this->load->view('main/field/message_info'); ?>
		<!-- Shopping Cart Table Starts -->
		<?php if($this->cart->total_items() > 0){ ?>
		<div class="table-responsive shopping-cart-table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td class="text-center">
							Image
						</td>
						<td class="text-center">
							Product Details
						</td>							
						<td class="text-center">
							Quantity
						</td>
						<td class="text-center">
							Size
						</td>
						<td class="text-center">
							Price
						</td>
						<td class="text-center">
							Total
						</td>
						<td class="text-center">
							Action
						</td>
					</tr>
				</thead>
				<tbody>
				<?php 
				$discount		= 0;
				foreach($this->cart->contents() as $item){ 
				$discount		= $discount + $item['discount'];
				?>
					<tr>
						<td class="text-center">
							<a href="<?php echo base_url()?>product/<?php echo $item['slug']?>">
								<img width="50%" src="<?php echo base_url()?>uploads/product/<?php echo $item['id']?>/thumb_<?php echo $item['gambar']?>" alt="Product Name" title="Product Name" class="img-thumbnail" />
							</a>
						</td>
						<td class="text-center">
							<a href="<?php echo base_url()?>product/<?php echo $item['slug']?>"><?php echo $item['name']?> <?php echo ($item['size_label'] == "" ? "" : "(".$item['size_label'].")")?></a>
						</td>							
						<td class="text-center" width="10%">
						<form method="post" action="<?php echo base_url()?>cart/update/<?php echo $item['rowid']?>">
						
							<div class="input-group btn-block">
								<input type="number" min="0" max="9999" name="quantity" id="input-quantity" value="<?php echo $item['qty']?>" size="1" class="form-control" required/>
							</div>								
						</td>
						<td class="text-center">
							<div class="input-group btn-block">
								<select name="size" id="input-quantity" required>
								<?php foreach($item['size_list'] as $sl){ ?>
									<option value="<?php echo $sl?>" <?php echo ($sl == $item['size_label'] ? "selected" : "") ?>><?php echo $sl?></option>
								<?php } ?>
								</select>
							</div>
						</td>
						<td class="text-center">
							Rp. <?php echo $this->cart->format_number($item['price'])?>
						</td>
						<td class="text-center">
							Rp. <?php echo $this->cart->format_number($item['subtotal'])?>
						</td>
						<td class="text-center">
							<button type="submit" title="Update" class="btn btn-default tool-tip">
								<i class="fa fa-refresh"> Update</i>
							</button>
							<a href="<?php echo base_url()?>cart/remove/<?php echo $item['rowid']?>" type="button" title="Remove" class="btn btn-default tool-tip">
								<i class="fa fa-times-circle"> Remove</i>
							</a>
						</td>
						</form>
						
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<?php if($discount > 0){ ?>
					
					<tr>
					  <td colspan="5" class="text-right">
						<strong>Total :</strong>
					  </td>
					  <td colspan="2" class="text-left">
						Rp. <?php echo $this->cart->format_number($this->cart->total())?>
					  </td>
					</tr>
					
					<tr>
					  <td colspan="5" class="text-right">
						<strong>Discount :</strong>
					  </td>
					  <td colspan="2" class="text-left">
						Rp. <?php echo $this->cart->format_number($discount)?>
					  </td>
					</tr>
					
					<?php } ?>
				
					<tr>
					  <td colspan="5" class="text-right">
						<strong>Total (Net):</strong>
					  </td>
					  <td colspan="2" class="text-left">
						Rp. <?php echo $this->cart->format_number($this->cart->total() - $discount)?>
					  </td>
					</tr>
				</tfoot>
			</table>				
		</div>
	<!-- Shopping Cart Table Ends -->
	<!-- Shipping Section Starts -->
		<section class="registration-area">
			<div class="row">
				<div class="col-sm-6">
					
					<!-- Discount Coupon Block Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Discount Coupon Code
							</h3>
						</div>
						<div class="panel-body">
						<!-- Form Starts -->
							<form class="form-horizontal" role="form" action="<?php echo base_url()?>cart/apply_coupon" method="post">
								<div class="form-group">
									<label for="inputCouponCode" class="col-sm-3 control-label">Coupon Code :</label>
									<div class="col-sm-9">
										<input type="text" name="coupon_code" class="form-control" id="inputCouponCode" placeholder="Coupon Code">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-default">
											Apply Coupon
										</button>
									</div>
								</div>
							</form>
						<!-- Form Ends -->
						</div>
					</div>
				<!-- Discount Coupon Block Ends -->
					
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
								<dt>Total :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($this->cart->total())?></dd>
								<dt>Coupon Discount :</dt>
								<dd>Rp. <?php echo $this->cart->format_number($discount) ?></dd>
							</dl>
							<hr>
							<dl class="dl-horizontal total">
								<dt>Total (Net):</dt>
								<dd>Rp. <?php echo($this->cart->format_number($this->cart->total() - $discount))?></dd>
							</dl>
							<hr>
							<div class="text-uppercase clearfix">
								<a class="btn btn-default pull-left col-md-6 col-sm-7 col-xs-12 xs500" href="<?php echo base_url()?>product" data-dismiss="modal">
									<span class="">Continue Shopping</span>
									<!-- <span class="visible-xs">Continue</span> -->
								</a>
								<a class="btn btn-default pull-right col-md-4 col-sm-4 col-xs-12 xs500" href="<?php echo base_url()?>cart/checkout">		
									Checkout
								</a>
							</div>
						</div>
					</div>
				<!-- Total Panel Ends -->
				</div>
			<!-- Discount & Conditions Blocks Ends -->
			</div>
		</section>
		
		<?php } else { ?>
			
			<div class="alert alert-success">
			  <strong>Hi!</strong> Your Cart Still Empty. Click the button below to see our products.
			</div>
			
			<div class="row">
				<div class="col-md-4 col-md-offset-4"><a href="<?php echo base_url()?>product" class="btn btn-block btn-lg btn-danger"><strong>GO SHOPPING</strong></a></div>
			</div>
			
		<?php } ?>
	<!-- Shipping Section Ends -->
	</div>
<!-- Main Container Ends -->