<!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Work list Section****** -->
    <br/>
    <section id="work-list" class="section work-list">
        <div class="container text-center">
            <h2 class="title">Photo Gallery</h2>
            <br/>
            <div class="items-wrapper isotope row galeri_library galeri_grid_style">
                <input type="hidden" class="table_content" value="galeri">
                <input type="hidden" name="ajax_url" id="ajax_url" val="<?php echo isset($ajax_url) ? $ajax_url : "" ?>" />
                
                <?php if($galeri_list->num_rows() > 0) : ?>
                <?php foreach($galeri_list->result() as $row) : ?>
                <div class="item startup saas col-lg-4 col-md-4 col-sm-6 col-sm-12 galeri_inside_start">
                    
                        <div class="item-inner">
                            <figure class="figure">
                                <a href="<?php echo site_url('galeri/'.$row->galeri_slug)?>">
                                    <img style="width:100%;" class="img-responsive bttrlazyloading bttrlazyload_library galeri_picture_thumb" src="<?php echo base_url() ?>uploads/galeri/<?php echo $row->galeri_slug ?>/thumb/<?php echo $row->galeri_picture ?>" />
                                </a>
                            </figure>
                            <div class="content text-left">
                                <h3 class="sub-title galeri_title">
                                    <a href="<?php echo site_url('galeri/'.$row->galeri_slug)?>" class="galeri_link galeri title"><?php echo $row->galeri_title; ?></a>
                                </h3>
                                <!-- <div class="meta">Startup / SaaS</div> -->
                            </div><!--//content-->                    
                        </div><!--//item-inner-->
                    
                </div><!--//item-->
                <?php endforeach; ?>
                <?php endif; ?>

                <div class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div><!-- pagination -->
                       
            </div><!--//items-wrapper-->
        </div><!--//container-fluid-->
    </section><!--//work-list"-->
    <br/>
    <!-- MAIN CONTENT WRAPPER END -->