    <?php 
    /*=====================================================
        1.  BREADCRUMB 
    =====================================================*/ ?>
    <?php if( count($this->breadcrumb) > 0 ): ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <?php 
                $br_num = 1;
                foreach($this->breadcrumb as $brc): ?>
                <?php if( $br_num == count($this->breadcrumb) ): ?>
                    
                    <?php 
                        /*=====================================================
                            ONLY FOR SINGLE PRODUCT PAGE
                        =====================================================*/
                        if( isset($_SERVER['HTTP_REFERER']) ):
                        if(     stripos($_SERVER['HTTP_REFERER'], 'category') < 0 
                            &&  $this->segment_1 == 'product'   
                        ): 
                            $url_array = explode('/', $_SERVER['HTTP_REFERER'] );   
                    ?>
                        <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php echo $url_array[count($url_array)-1]; ?></a></li>
                    <?php endif; ?>
                    <?php endif; ?>
                    

                    <li class="active"><?php echo str_replace('_',' ',str_replace('-', ' ', $brc['name'])); ?></li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo $brc['url']; ?>">
                            <?php echo str_replace('_',' ',str_replace('-', ' ', $brc['name'])); ?>
                        </a>
                    </li>
                <?php endif;?>
            <?php 
                $br_num++;

                endforeach; ?>
        </ol>   
    <?php endif; ?>