		<?php
							$page = 4;
							$offset = ($link-1) * $page;
							$sql = "SELECT * FROM tourism_place LIMIT $offset,$page";
							$pagings  = $this->db->query($sql);

							 foreach ($pagings->result() as $rev ) {
							?>
							<div class="review-user">
										<div class="res">
									<h4 class="title-rev"><?php echo $rev->tourism_place_id; ?> Teluk Kiluan</h4>
								 <a href="">	<i class="when"> Read More </i> </a>
									</div>
									<div class="cleaner"></div>
									<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Sumatera Selatan / Jan 2017 </p>
									<hr>
							</div>
							<?php } ?>