<!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Blog Post****** -->
    <div class="blog-post-wrapper container blog_single">            
        <div class="row">
            <div class="blog-entry col-md-12 col-sm-12 col-xs-12">                 
                <article class="post">
                    <h2 class="title galeri_title"><?php echo $galeri->galeri_title?></h2>
                    <div class="meta">
                        <ul class="meta-list list-inline">                                       
                        	<li class="post-time date updated">
                                <i class="fa fa-calendar"></i> 
                                <span class="galeri_create_date"><?php echo $galeri->create_date; ?></span>
                            </li>
                        	<li class="post-author"><i class="fa fa-user"></i> <a href="#">James Lee</a></li>
                        	<li class="post-comments-link">
                    	        <a href="#comment-area"><i class="fa fa-comments"></i>5 Comments</a>
                    	    </li>
                    	</ul><!--//meta-list-->                           	
                    </div><!--meta-->
                    <div class="content">
                        <p class="post-figure ">
                            <img style="width:100%" class="img-responsive galeri_picture" src="<?php echo base_url()?>uploads/galeri/<?php echo $galeri->galeri_slug?>/<?php echo $galeri->galeri_picture?>" />
                        </p><!--//post-figure-->
                        <div class="galeri_description">
                            <?php echo $galeri->galeri_description?>
                        </div><!-- galeri_description -->             
                    </div>
                    <br />
					
                    <div class"b=log-entry col-md-12 col-sm-12 col-xs-12"> 
		                <?php if($galeri_picture_list->num_rows() > 0) : ?>
		                <div class="row masonry-grid">
		                    <?php foreach($galeri_picture_list->result() as $row) : ?>
		                    <div class="col-md-4">
		                        <div class="photo-gallery">
		                            <div class="photo-img">
		                                <div class="thumb">
		                                    <img class="galeri_picture_thumb" style="width:100%" src="<?php echo base_url()?>uploads/galeri/<?php echo $galeri->galeri_slug?>/thumb/<?php echo $row->galeri_picture_picture; ?>">
		                                </div>
		                            </div>
		                            <div class="photo-desc">
		                                <?php echo $row->galeri_picture_title?>
		                            </div>
		                        </div>
		                    </div>
		                    <?php endforeach; ?>
		                </div>
		                <?php endif; ?>
		            </div>
		            <br />
			              
                
    				                                         
                </article><!--//post-->                                      
            </div><!--//blog-entry-->
            
                    
        </div><!--//row-->
    </div><!--//blog--><!-- blog_single -->
    <!-- MAIN CONTENT WRAPPER END -->