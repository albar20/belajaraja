<!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Work list Section****** -->
    <br/>
    <section id="work-list" class="section work-list">
        <div class="container text-center">
            <h2 class="title">Video Gallery</h2>
            <br/>
            <div class="items-wrapper isotope row video_library video_grid_style"><input type="hidden" class="table_content" value="video">
                
                <br /> 	
			    <?php if($video_list->num_rows() > 0) : ?>
				<?php foreach($video_list->result() as $row) : ?>
	            <div class="item startup saas col-lg-4 col-md-4 col-sm-6 col-sm-12 video_inside_start">
                    <div class="item-inner">
                        <figure class="figure">
                            <div class="thumb">	
								<?php if($row->video_link != ''): ?> 
                            	<?php     
                                    $id = '';
                                    $url = $row->video_link;
                                    preg_match(
                                                "/[\\?\\&]v=([^\\?\\&]+)/",
                                                $url,
                                                $matches
                                                );
                                    if( count($matches) > 0 ){
                                        $id = $matches[1];
                                    }
                            	?>
                            	
                                <a href="<?php echo site_url('video/'.$row->video_slug)?>">
                                    <img style="width:100%" class="img-responsive bttrlazyloading bttrlazyload_library video_image" src="http://img.youtube.com/vi/<?php echo $id; ?>/default.jpg" /></a>
                            </div><!-- thumb_end -->
						    <?php endif; ?>
                        </figure>
                        <div class="content text-left">
                            <h3 class="sub-title">
                                <a href="<?php echo site_url('video/'.$row->video_slug)?>" class="video_link video title"><?php echo $row->video_title; ?></a></h3>
                            <!-- <div class="meta">Startup / SaaS</div> -->
                        </div><!--//content-->                    
                    </div><!--//item-inner-->
                </div><!--//item-->
				<?php endforeach; endif; ?>
                <div style="clear:both"></div>
                <br />
				
                <div class="pagination_video pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div><!-- pagination -->
                       
            </div><!--//items-wrapper-->
        </div><!--//container-fluid-->
    </section><!--//work-list"-->

    

    <!-- MAIN CONTENT WRAPPER END -->