<!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Blog list Section****** -->
    <section id="blog-list" class="blog-list section">
        <div class="container">
            <h2 class="title category_title"><?php echo set_value('category_title', isset($category->category_title) ? ucwords($category->category_title) : 'Post'); ?></h2>
            <?php if($blog_list->num_rows() > 0) : ?>
                <?php foreach($blog_list->result() as $row) : ?>
                <?php $category = isset($row->category_id) && $row->category_id != '' && $this->model_utama->cek_data($row->category_id,'category_id','category')->num_rows() > 0 ? $this->model_utama->get_detail($row->category_id,'category_id','category')->row()->category_slug : ''; ?>
                    <article class="item post_inside ">                
                    <div class="row">
                        <h3 class="post-title col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                            <a href="<?php echo site_url($category.'/'.$row->blog_slug)?>" class="post_title post_link"><?php echo ucwords($row->blog_title)?></a></h3>
                        <div class="clearfix"></div>
                        <div class="meta col-md-2 col-sm-3 col-xs-12 text-right">
                            <ul class="meta-list list-unstyled">                                       
                            	<li class="post-time post_date date updated"><?php echo date('d F Y',strtotime($row->create_date)); ?></li>
                            	<li class="post-author"><a href="#">Sara Valdez</a></li>
                            	<li class="post-comments-link">
                        	        Comments: <a href="blog-post.html#comment-area">8</a>
                        	    </li>
                        	</ul><!--//meta-list-->                           	
                        </div><!--//meta-list-->                    
                        <div class="content-wrapper col-md-10 col-sm-9 col-xs-12">
                            <div class="content-wrapper col-md-3 col-sm-9 col-xs-12">
                                <figure class="figure">
                                    <a href="blog-post.html">
                                        <img class="img-responsive post_picture" 
                                            src="<?php echo base_url()?>uploads/blog/<?php echo $row->blog_slug?>/thumb/<?php echo $row->blog_picture?>"
                                            alt="<?php echo ucwords($row->blog_title)?>">
                                    </a>
                                </figure>
                            </div>
                            <div class="content">
                                <div class="desc post_description"><?php echo word_limiter(strip_tags($row->blog_description),40);?><!--//desc--><!-- post_description -->
                            </div><!--//content-->
                        </div><!--//content-wrapper-->   
                    </div><!--//row-->            
                </article><!--//item-->
                <br/>
                <?php endforeach; ?>
                <br/>
                <article class="item">               
                    <div class="pagination-container text-center pagination pagination_start">
                        <?php echo $this->pagination->create_links();?></div><!-- pagination_start -->
                    <?php else : ?>
                    <div class="well"> 
                        Data tidak ada
                    </div>
    	    	<?php endif; ?>       
                </article><!--//item-->
                <br/>
        </div><!--//container-->
    </section><!--//blog-list--> 
    <!-- MAIN CONTENT WRAPPER END -->