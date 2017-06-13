<!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Blog Post****** -->
    <div class="blog-post-wrapper container blog_single">            
        <div class="row">
            <div class="blog-entry col-md-12 col-sm-12 col-xs-12">                 
                <article class="post">
                    <h2 class="title video_title"><?php echo ucwords($video->video_title); ?></h2>
                    <div class="meta">
                        <ul class="meta-list list-inline">                                       
                        	<li class="post-time date updated">
                                <i class="fa fa-calendar"></i> 
                                <span class="video_create_date"><?php echo $video->create_date; ?></span>
                            </li>
                        	<li class="post-author"><i class="fa fa-user"></i> <a href="#">James Lee</a></li>
                        	<li class="post-comments-link">
                    	        <a href="#comment-area"><i class="fa fa-comments"></i>5 Comments</a>
                    	    </li>
                    	</ul><!--//meta-list-->                           	
                    </div><!--meta-->
                    <div class="content">
                        
					<?php if($video->video_link != ''): ?> 
                	<?php    
                        $id = '';
                    	$url = $video->video_link;
                        preg_match(
                                "/[\\?\\&]v=([^\\?\\&]+)/",
                                $url,
                                $matches
                            );
                        if( count($matches) > 0 ){
                            $id = $matches[1];
                        }
				   	?>
				   	<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $id?>" frameborder="0" allowfullscreen></iframe>
	                <?php endif; ?>
				   	
                        <div class="video_description"><?php echo $video->video_description; ?></div><!-- video_description -->             
                    </div>
                    
                    
					<div class"b=log-entry col-md-12 col-sm-12 col-xs-12 video-list-wrapper">
                        <?php if($video_list_list->num_rows() > 0) : ?>
                     	<div class="row masonry-grid">
                            <?php foreach($video_list_list->result() as $row) : ?>
                            <?php 
                                $url = $row->video_list_link;
                                preg_match(
                                        "/[\?\&]v=([^\?\&]+)/",
                                        $url,
                                        $matches
                                    );
                            ?>
                            <?php if( count($matches) > 0): 
                                $id = $matches[1];
                            ?>
                            <div class="col-md-4 col-sm-4 col-xs-6 video-list-inside">
                                <div class="col-md-11 col-sm-11 col-xs-11 video-list">
                                    <a style="" href="<?php echo $url; ?>" class="video_list_link" title="Welcome1" data-gallery="">
                                        <img    class="img-responsive video_list_picture" 
                                                src="http://img.youtube.com/vi/<?php echo $id?>/default.jpg" 
                                                alt="<?php echo ucwords($row->video_list_title)?>" 
                                                style="width:100%"
                                                />
                                        Welcome1                            
                                        <span class="video_list_title"><?php echo ucwords(character_limiter($row->video_list_title,20))?></span> 
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="clear"></div>
                        <?php endif; ?>
                    </div><!-- video-list-wrapper END -->
                    <br />
			                         
                </article><!--//post-->                                      
            </div><!--//blog-entry-->
            
                    
        </div><!--//row-->
    </div><!--//blog--><!-- blog_single -->
    <!-- MAIN CONTENT WRAPPER END -->