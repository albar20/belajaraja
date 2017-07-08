<table class="table table-condensed review">
			<thead>
				<tr>
					<th class="images">

					</th>
					<th ></th>
					<th >Rating</th>
					<th class="helpfull">Helpful Votes</th>
					<th class="points">Points</th>
				</tr>

				<?php foreach ($review as $rev) {?>
				<tr>
					<td>
  <img class="image_review" src="<?php echo base_url() ?>uploads/wisata/asdasdsad/thumb/thumb_11DreadOut_branding_image.jpg"></td>
					<td class="desc">
							<a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>
<?php echo $rev->tourism_place_id; ?> Barcelona: Hotel The Serras</a>
								<h3> <i> "Stunning Hotel" </i> </h3>
								<p>Top-notch hotel in a beautiful location. The staf...</p>
								<b><i class="fa fa-calendar" aria-hidden="true"></i>
 Jun 12, 2017 </b> </td>
					<td class="rating">
						
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						
					</td>
					<td class="help"> <h3>10 <i class="fa fa-thumbs-up" aria-hidden="true"></i></h3> </td>
					<td class="points"> <h3>100</h3> </td>
				</tr>
				<?php } ?>


			</thead>
		</table>
		