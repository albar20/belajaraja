<div id="main-container" class="container">
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Shopping Cart
		</h2>
		<?php $this->load->view('main/field/message_info'); ?>
	<!-- Main Heading Ends -->
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
							<a href="product.html">
								<img src="<?php echo base_url()?>assets/fashion/images/product-images/cart-thumb-img2.jpg" alt="Product Name" title="Product Name" class="img-thumbnail" />
							</a>
						</td>
						<td class="text-center">
							<a href="product-full.html"><?php echo $item['name']?></a>
						</td>							
						<td class="text-center">
							<div class="input-group btn-block btn-warning">
								<input type="text" name="quantity" value="<?php echo $item['qty']?>" size="1" class="form-control" />
							</div>								
						</td>
						<td class="text-center">
							Rp. <?php echo $this->cart->format_number($item['price'])?>
						</td>
						<td class="text-center">
							Rp. <?php echo $this->cart->format_number($item['subtotal'])?>
						</td>
						<td class="text-center">
							<a href="<?php echo base_url()?>cart/update/<?php echo $item['rowid']?>" type="button" title="Update" class="btn btn-warning tool-tip">
								<i class="fa fa-refresh"></i>
							</a>
							<a href="<?php echo base_url()?>cart/remove/<?php echo $item['rowid']?>" type="button" title="Remove" class="btn btn-warning tool-tip">
								<i class="fa fa-times-circle"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<?php if($discount > 0){ ?>
					
					<tr>
					  <td colspan="4" class="text-right">
						<strong>Total :</strong>
					  </td>
					  <td colspan="2" class="text-left">
						Rp. <?php echo $this->cart->format_number($this->cart->total())?>
					  </td>
					</tr>
					
					<tr>
					  <td colspan="4" class="text-right">
						<strong>Discount :</strong>
					  </td>
					  <td colspan="2" class="text-left">
						Rp. <?php echo $this->cart->format_number($discount)?>
					  </td>
					</tr>
					
					<?php } ?>
				
					<tr>
					  <td colspan="4" class="text-right">
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
										<button type="submit" class="btn btn-warning">
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
								<a class="btn btn-warning pull-left" href="#" data-dismiss="modal">
									<span class="hidden-xs">Continue Shopping</span>
									<span class="visible-xs">Continue</span>
								</a>
								<a class="btn btn-warning pull-right" href="#">		
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
		
		<?php } ?>
	<!-- Shipping Section Ends -->
	</div>