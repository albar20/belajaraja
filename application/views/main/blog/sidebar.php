            <br/>            
            <!-- SIDEBAR BEGIN -->
            <aside id="blog-sidebar" class="blog-sidebar col-md-3 col-sm-4 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                <section class="widget search">
                    <h3 class="sr-only title">Search Blog</h3>
                    <form class="search-blog-form">
                        <div class="form-group col-md-10 col-sm-10 col-xs-10 search-blog-wrapper">
                            <input type="text" class="form-control" id="search_blog_keyword" placeholder="Search blog...">
                        </div>
                        <div class="form-group col-md-2 col-sm-2 col-xs-2">
                            <button type="button" id="search_button_blog" class="btn btn-cta btn-cta-secondary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </section><!--//search-->
                <section class="widget recent-posts">
                    <h3 class="title">Recent Posts</h3>
                    <ul class="list-unstyled">
                        <?php if( isset($recent_post_list) ): ?>
                        <?php if( count($recent_post_list->result()) > 0 ): ?>
                        <?php foreach( $recent_post_list->result() as $rl ): ?>
                        <li>
                            <img class="thumb img-responsive" src="assets/images/blog/blog-tiny-thumb-1.jpg" alt="" />
                            <span class="post-info">
                                <a class="post-title" href="#"><?php echo $rl->blog_title; ?></a><br />
                                <span class="date"><?php echo $rl->blog_date ?></span>
                            </span>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </section><!--//widget-->
                
                <?php if($category_list->num_rows() > 0) : ?>
                <section class="widget categories">
                    <h3 class="title">Categories</h3>
                    <ul class="list-unstyled">
                        <?php foreach($category_list->result() as $row) : ?>
                            <li><a href="<?php echo site_url($row->category_slug)?>"><?php echo $row->category_title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </section><!--//widget-->
                <?php endif; ?>
                <!-- <section class="widget archives">
                    <h3 class="title">Archives</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">June 2014 <span class="count">(3)</span></a></li>
                        <li><a href="#">May 2014 <span class="count">(5)</span></a></li>
                        <li><a href="#">April 2014 <span class="count">(4)</span></a></li>
                        <li><a href="#">March 2014 <span class="count">(2)</span></a></li>
                    </ul>
                </section> --><!--//widget-->
                <?php if($popular_blog_list->num_rows() > 0) : ?>
                <section class="widget recent-blogs">
                    <h3 class="title">Popular blogs</h3>
                    <ul class="list-unstyled">
                    <?php foreach ($popular_blog_list->result() as $row) : ?>
                        <?php $cek_blog = $this->model_utama->cek_data($row->judul_blog,'blog_title','blog'); ?>
                        <?php if($cek_blog->num_rows() > 0) : $blog = $cek_blog->row(); ?>
                        <?php   
                            $category = isset($blog->category_id) && $blog->category_id != '' 
                                        ? ucwords($this->model_utama->get_detail($blog->category_id,'category_id','category')->row()->category_title) 
                                        : ''; 
                        ?>
                        <li><a href="<?php echo site_url(url_title($category, 'dash', TRUE).'/'.$blog->blog_slug); ?>"><?php echo $row->judul_blog?></a><br /><span class="date"><?php echo date('d F Y',strtotime($blog->create_date)); ?></span></li>

                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </section><!--//widget-->
                <?php endif; ?>
                
            </aside><!--//blog-side-bar-->
            <!-- SIDEBAR END -->