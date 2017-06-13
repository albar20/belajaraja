    
                <ul class="list-unstyled list-inline text-uppercase menu">
                    <li class=""><a href="<?php echo base_url()?>">Home</a></li>
                    <?php $menu_list = $this->model_utama->get_order('menu_order','asc','menu');?>
                    <?php if($menu_list->num_rows() > 0) : $i = 1; ?>
                    <?php foreach($menu_list->result() as $menu) : ?>
                    <?php $menu_lv1_list = $this->model_utama->cek_order($menu->menu_id,'menu_id','menu_lv1_order','asc','menu_lv1');?>
                    <li  class=" <?php if($menu_lv1_list->num_rows() > 0) : ?>dropdown<?php endif; ?>">
                        <a <?php if($menu_lv1_list->num_rows() > 0) : ?>class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"<?php endif; ?> href="<?php echo isset($menu->menu_type) && $menu->menu_type == 'out' ? $menu->menu_link : site_url($menu->menu_link); ?>" <?php if($menu->menu_type == 'out') : ?>target="_blank"<?php endif; ?>><?php echo $menu->menu_title?> <?php if($menu_lv1_list->num_rows() > 0) : ?><i class="fa fa-angle-down"></i><?php endif; ?></a>
                        <?php if($menu_lv1_list->num_rows() > 0) : ?>
                        <ul class="dropdown-menu">
                            <?php foreach($menu_lv1_list->result() as $menu_lv1) : ?>
                            <?php $menu_lv2_list = $this->model_utama->cek_order($menu_lv1->menu_lv1_id,'menu_lv1_id','menu_lv2_order','asc','menu_lv2');?>
                            <li <?php if($menu_lv2_list->num_rows() > 0) : ?>class="dropdown"<?php endif; ?>>
                                <a href="<?php echo isset($menu_lv1->menu_lv1_type) && $menu_lv1->menu_lv1_type == 'out' ? $menu_lv1->menu_lv1_link : site_url($menu_lv1->menu_lv1_link); ?>" <?php if($menu_lv1->menu_lv1_type == 'out') : ?>target="_blank"<?php endif; ?>><?php echo $menu_lv1->menu_lv1_title; ?> </a>
                                <?php if($menu_lv2_list->num_rows() > 0) : ?>
                                <ul class="dropdown-menu">
                                    <?php foreach($menu_lv2_list->result() as $menu_lv2) : ?>
                                    <li><a href="<?php echo isset($menu_lv2->menu_lv2_type) && $menu_lv2->menu_lv2_type == 'out' ? $menu_lv2->menu_lv2_link : site_url($menu_lv2->menu_lv2_link); ?>" <?php if($menu_lv2->menu_lv2_type == 'out') : ?>target="_blank"<?php endif; ?>><?php echo $menu_lv2->menu_lv2_title; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>                            
                        </ul>
                        <?php endif; ?>
                    </li>
                   
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if( $this->session->userdata('login_customer') == true ): ?>  
                    <li class="">
                        <a href="<?php echo base_url()?>my_account" ><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
                    </li>
                    <?php endif ?>  
                    <li class="">
                        <?php if( $this->session->userdata('login_customer') == true ): ?>    
                            <a href="<?php echo base_url()?>logout" title="logout" ><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        <?php else: ?>
                            <a href="<?php echo base_url()?>login" title="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                        <?php endif ?>
                    </li>
                </ul><!--//nav-->
        