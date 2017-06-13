<?php

    $user_id                = $this->session->userdata('id_user');

    $user                   = $this->db->query("select * from user where user.user_id = '$user_id'")->row();



?>



<div id="main-menu" role="navigation">

        <div id="main-menu-inner">

            <div class="menu-content top" id="menu-content-demo">

                <!-- Menu custom content demo

                     CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss

                     Javascript: html/<?php echo base_url()?>assets/demo/demo.js

                 -->

                <div>

                    <div class="text-bg"><span class="text-semibold"><?php echo character_limiter(set_value('user_picture', isset($user->user_name) ? ucwords($user->user_name) : 'Weleh'),10); ?></span></div>



                    <img width="150" src="<?php echo base_url()?>uploads/user/thumb/<?php echo set_value('user_picture', isset($user->user_detail_picture) ? ucwords($user->user_detail_picture) : 'default.jpg'); ?>" class="img img-responsive">

                    <div class="btn-group">

                        <a href="<?php echo base_url() ?>admin/user" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>

                        <a href="<?php echo base_url() ?>admin/setting" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>

                        <a href="<?php echo site_url('login/logout')?>" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>

                    </div>

                    <a href="#" class="close">&times;</a>

                </div>

            </div>

            <ul class="navigation">





                        <li <?php if($this->uri->segment(2) == 'dashboard') { ?>class="active"<?php } ?>>

                            <a href="<?php echo site_url('admin/dashboard')?>"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>

                        </li>





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-book"></i><span class="mm-text">E-Book</span></a>

                            <ul>



                                <li <?php if($this->uri->segment(2) == 'ebook_category') { ?>class="active"<?php } ?>>

                                    <a tabindex="-1"  href="<?php echo base_url()?>admin/ebook_category"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('kategori ebook'); ?></span></a>

                                </li>



                                <li <?php if($this->uri->segment(2) == 'ebook') { ?>class="active"<?php } ?>>

                                    <a href="<?php echo base_url()?>admin/ebook"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('ebook'); ?></span></a>

                                </li>

                            </ul>

                        </li>





                        <li>

                            <a href="<?php echo site_url('admin/user')?>"><i class="menu-icon fa fa-users"></i><span class="mm-text">User</span></a>

                        </li>





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Post</span></a>

                            <ul>

                                <li>

                                    <a href="<?php echo site_url('admin/category')?>"><i class="menu-icon fa fa-check-square"></i><span class="mm-text">Kategori</span></a>

                                </li>

                                <li>

                                    <a href="<?php echo site_url('admin/subcategory')?>"><i class="menu-icon fa fa-check"></i><span class="mm-text">Sub Kategori</span></a>

                                </li>

                                <li class="mm-dropdown">                           

                                    <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">List Post</span></a>

                                    <ul>

                                        <li>

                                            <a  tabindex="-1" href="<?php echo site_url('admin/post')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('all post'); ?></span></a>

                                        </li>

                                        <?php $category_list = $this->model_utama->get_order('category_title','asc','category'); ?>

                                        <?php if($category_list->num_rows() > 0) : ?>

                                            <?php foreach($category_list->result() as $row) : ?>

                                                <li>

                                                    <a  tabindex="-1" href="<?php echo site_url('admin/post/category/'.$row->category_id)?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords($row->category_title); ?></span></a>

                                                </li>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </ul>

                                </li>

                                <li>

                                    <a tabindex="-1" href="<?php echo site_url('admin/post/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah post'); ?></span></a>

                                </li>

                                

                            </ul>

                        </li>                    





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-archive"></i><span class="mm-text">Halaman Dalam</span></a>

                            <ul>

                                <li>

                                    <a  tabindex="-1" href="<?php echo site_url('admin/page')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('halaman'); ?></span></a>

                                </li>

                                <li>

                                    <a tabindex="-1" href="<?php echo site_url('admin/page/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah halaman'); ?></span></a>

                                </li>

                                

                            </ul>

                        </li>               




                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Slider</span></a>

                            <ul>

                                <li>

                                    <a  tabindex="-1" href="<?php echo site_url('admin/slider')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('slider'); ?></span></a>

                                </li>

                                <li>

                                    <a tabindex="-1" href="<?php echo site_url('admin/slider/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah slider'); ?></span></a>

                                </li>

                                

                            </ul>

                        </li>               





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Banner</span></a>

                            <ul>

                                <li>

                                    <a  tabindex="-1" href="<?php echo site_url('admin/banner')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('banner'); ?></span></a>

                                </li>

                                <li>

                                    <a tabindex="-1" href="<?php echo site_url('admin/banner/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah banner'); ?></span></a>

                                </li>

                                

                            </ul>

                        </li>               





                        <li>

                            <a href="<?php echo site_url('admin/menu')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text">Menu</span></a>

                        </li>               





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Galeri</span></a>

                            <ul>



                                <li <?php if($this->uri->segment(2) == 'galeri_category') { ?>class="active"<?php } ?>>

                                    <a tabindex="-1"  href="<?php echo site_url('admin/galeri_category')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('galeri category'); ?></span></a>

                                </li>



                                <li <?php if($this->uri->segment(2) == 'galeri') { ?>class="active"<?php } ?>>

                                    <a tabindex="-1"  href="<?php echo site_url('admin/galeri')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('galeri'); ?></span></a>

                                </li>

                            </ul>

                        </li>               





                        <li class="mm-dropdown">

                            <a href="#"><i class="menu-icon fa fa-youtube-play"></i><span class="mm-text">Video</span></a>

                            <ul>

                                <li <?php if($this->uri->segment(2) == 'video_category') { ?>class="active"<?php } ?>>

                                    <a href="<?php echo site_url('admin/video_category')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('video category'); ?></span></a>

                                </li>



                                <li <?php if($this->uri->segment(2) == 'video') { ?>class="active"<?php } ?>>

                                    <a href="<?php echo site_url('admin/video')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('video'); ?></span></a>

                                </li>

                            </ul>

                        </li>               





                    <li class="mm-dropdown">

                        <a href="#"><i class="menu-icon fa fa-gear"></i><span class="mm-text">Log</span></a>

                        <ul>

                            <li <?php if($this->uri->segment(2) == 'log_user') { ?>class="active"<?php } ?>>

                                <a tabindex="-1"  href="<?php echo site_url('admin/log/log_user')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text">

                                    <?php echo ucwords('Log User'); ?></span></a>

                            </li>

                            <li <?php if($this->uri->segment(2) == 'log_user_activity') { ?>class="active"<?php } ?>>

                                <a tabindex="-1"  href="<?php echo site_url('admin/log/log_user_activity')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text">

                                    <?php echo ucwords('Log User Activity'); ?></span></a>

                            </li>

                            <li <?php if($this->uri->segment(2) == 'log_visitor') { ?>class="active"<?php } ?>>

                                <a tabindex="-1"  href="<?php echo site_url('admin/log/log_visitor')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text">

                                    <?php echo ucwords('Log Visitor'); ?></span></a>

                            </li>

                        </ul>

                    </li>      







                    <li>

                        <a href="<?php echo site_url('admin/banner')?>"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Popup Home</span></a>

                    </li>   



                <?php // endforeach;?>

                <?php //if($this->session->userdata('login_status') == 'super_admin') : ?>



                <li class="mm-dropdown">

                    <a href="#"><i class="menu-icon fa fa-plane"></i><span class="mm-text">Tourism Place</span></a>

                    <ul>



                        <li <?php if($this->uri->segment(2) == 'tourism_place') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo base_url()?>admin/tourism_place"><i class="menu-icon fa fa-tag"></i><span class="mm-text"><?php echo ucwords('Add Place'); ?></span></a>

                        </li>



                        <li <?php if($this->uri->segment(2) == 'product_subcategory') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo base_url()?>admin/product_subcategory"><i class="menu-icon fa fa-tags"></i><span class="mm-text"><?php echo ucwords('Product Subcategory'); ?></span></a>

                        </li>

                        

                        <li <?php if($this->uri->segment(2) == 'additional_info') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo base_url()?>admin/additional_info"><i class="menu-icon fa fa-tags"></i><span class="mm-text"><?php echo ucwords('Category Specific Info'); ?></span></a>

                        </li>

                        

                        <li <?php if($this->uri->segment(2) == 'product') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo base_url()?>admin/product"><i class="menu-icon fa fa-briefcase"></i><span class="mm-text"><?php echo ucwords('List Product'); ?></span></a>

                        </li>                                               <li <?php if($this->uri->segment(2) == 'coupon') { ?>class="active"<?php } ?>>                          <a tabindex="-1"  href="<?php echo base_url()?>admin/coupon"><i class="menu-icon fa fa-briefcase"></i><span class="mm-text"><?php echo ucwords('List Kupon'); ?></span></a>                     </li>

                    </ul>

                </li>

                

                <li>

                    <a href="<?php echo site_url('admin/customer')?>"><i class="menu-icon fa fa-users"></i><span class="mm-text">Customers</span></a>

                </li>

                <li>

                    <a href="<?php echo site_url('admin/seller')?>"><i class="menu-icon fa fa-gear"></i><span class="mm-text">Seller Info</span></a>

                </li>

                <li>

                    <a href="<?php echo site_url('admin/order')?>"><i class="menu-icon fa fa-gear"></i><span class="mm-text">

                        Orders & Tracking ( <?php  //echo $this->total_order_waiting_approval; //on, my_controller.php ?> )

                    </span></a>

                </li>

                <li>

                    <a href="<?php echo site_url('admin/setting')?>"><i class="menu-icon fa fa-gear"></i><span class="mm-text">Setting</span></a>

                </li>

                <?php //endif; ?>

            </ul> <!-- / .navigation -->

            <div class="menu-content">

                <a href="#" class="btn btn-primary btn-block btn-outline dark">Develop By Babastudio</a>

            </div>

        </div> <!-- / #main-menu-inner -->

    </div> <!-- / #main-menu -->