<br/>
<!-- ******BLOG LIST****** --> 
<div class="blog container">
    <h2 class="title"><?php echo set_value('category_title', isset($category->category_title) ? ucwords($category->category_title) : 'Blog'); ?></h2>
    <div class="row">
        <div id="blog-list" class="blog-list section col-md-8 col-sm-8 col-xs-12">
            <?php if($blog_list->num_rows() > 0) : ?>
                <?php foreach($blog_list->result() as $row) : ?>
                <?php $category = isset($row->category_id) && $row->category_id != '' && $this->model_utama->cek_data($row->category_id,'category_id','category')->num_rows() > 0 ? $this->model_utama->get_detail($row->category_id,'category_id','category')->row()->category_slug : ''; ?>

                <article class="post">
                    <?php if($row->blog_picture != '') : ?>
                    <div class="post-thumb col-md-4 col-sm-12 col-xs-12">
                        <img class="img-responsive post_picture" 
                            src="<?php echo base_url()?>uploads/blog/<?php echo $row->blog_slug?>/thumb/<?php echo $row->blog_picture?>"  
                            alt="<?php echo ucwords($row->blog_title)?>" />
                        <br/>
                        <!-- <img class="bttrlazyloading img-responsive" data-bttrlazyloading-md-src="<?php echo base_url()?>uploads/blog/<?php echo $row->blog_slug?>/<?php echo $row->blog_picture?>"  alt="" /> -->
                    </div><!--//post-thumb-->
                    <?php endif; ?>
                    <div class="content">
                        <h3 class="post-title"><a href="<?php echo site_url($category.'/'.$row->blog_slug)?>"><?php echo ucwords($row->blog_title)?></a></h3>
                        <div class="meta">
                            <ul class="meta-list list-inline">                                       
                                <li class="post-time post_date date updated"><?php echo date('d F Y',strtotime($row->create_date)); ?></li>
                                <!-- <li class="post-author"> by <a href="#">Admin</a></li> -->
                            </ul><!--//meta-list-->                             
                        </div><!--meta-->
                        <div class="post-entry">
                            <p><?php echo word_limiter(strip_tags($row->blog_description),40);?></p>
                            <a class="read-more" href="<?php echo site_url($category.'/'.$row->blog_slug)?>">Read more <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </article>
                <br/>
                <?php endforeach; ?>
                <div class="pagination">
                    <?php echo $this->pagination->create_links();?>
                </div>
            <?php else : ?>
                <div class="well"> 
                    Data tidak ada
                </div>
            <?php endif; ?>
        </div><!--//blog-list-->
        <!-- blog side bar -->
        <?php $this->load->view('main/blog/sidebar'); ?>
        <!--//blog-side-bar-->   
        <div class="clear"></div>
        <br/>            
    </div><!--//row-->
</div><!--//blog