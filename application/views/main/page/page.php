
    <!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******team Section****** -->
    <br/>
    <section id="team" class="team section page_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">                     
                    <h2 class="title page_title"><?php echo ucwords($pages->page_title)?></h2>
                    <?php if( $pages->page_picture != '' ): ?>
                        <img style="width:100%" class="image-page page_picture" src="<?php echo base_url(); ?>uploads/page/<?php echo $pages->page_slug; ?>/<?php echo $pages->page_picture; ?>">
                    <?php endif; ?>
                    <br />
                    <br />
                    <div class="row page_description"><?php echo $pages->page_description?></div><!-- page_description -->
                </div>
            </div>
        </div><!--//container-->
    </section><!--//team-section-->
    <br/>
    <!-- MAIN CONTENT WRAPPER END -->
