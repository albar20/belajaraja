                        <div id="cart" class="btn-group btn-block">
                            <button type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle text-uppercase">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="cart-total"><?php echo $this->cart->total_items()?> item(s)</span>
                                <i class="fa fa-caret-down"></i>
                            </button>
							
                            <ul class="dropdown-menu">
                                <?php if($this->cart->total_items() == 0){ ?>
								<li>
                                    <p class="text-center">Your shopping cart is empty!</p>
                                </li>              
								<?php } else { ?>
                                <li>
                                    <table class="table hcart">
                                        <?php
                                        $discount		= 0;
										foreach($this->cart->contents() as $row){
										$discount	= $discount + $row['discount'];
										?>
										<tr>
                                            <td class="text-center">
                                                <a href="<?php base_url() ?>product/<?php echo $row['slug']; ?>">
                                                    <img src="<?php echo base_url() ?>uploads/product/<?php echo $row['id'] ?>/thumb_<?php echo $row['gambar'] ?>" 
                                                        alt="image" title="image" class="img-thumbnail img-responsive" />
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                <a href="<?php base_url() ?>product/<?php echo $row['slug']; ?>">
                                                    <?php echo $row['name']?>
                                                </a>
                                            </td>
                                            <td class="text-right">x <?php echo $row['qty']?></td>
                                            <td class="text-right">Rp.<?php echo $this->cart->format_number($row['subtotal'])?></td>
                                            <td class="text-center">
                                                <a href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
										<?php } ?>
                                    </table>
                                </li>
                                <li>
                                    <table class="table table-bordered total">
                                        <tbody>
                                            <tr>
                                                <td class="text-right"><strong>Total</strong></td>
                                                <td class="text-left">Rp. <?php echo $this->cart->format_number($this->cart->total())?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Discount</strong></td>
                                                <td class="text-left">Rp. <?php echo $this->cart->format_number($discount)?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Total (Net)</strong></td>
                                                <td class="text-left">Rp. <?php echo $this->cart->format_number($this->cart->total() - $discount)?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="text-right btn-block1">
                                        <a href="<?php echo base_url()?>cart">
                                            View Cart
                                        </a>
                                        <a href="<?php echo base_url()?>cart/checkout">
                                            Checkout
                                        </a>
                                    </p>
                                </li>        
								<?php } ?>
                            </ul>
                        </div>