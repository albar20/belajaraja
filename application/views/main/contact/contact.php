<?php 
/*================================================
    1.  PHONE AND EMAIL ADDRESS
    2.  MESSAGE INFO
    2.  KONTAK FORM 
    3.  MAP
================================================*/ ?>

    <!-- MAIN CONTENT WRAPPER BEGIN -->
    <!-- ******Contact Section****** --> 
    <section class="contact-section section">
        <div class="container">
            <h2 class="title text-center">Start your project today</h2>
            <p class="intro text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet tortor consequat nisi scelerisque commodo etiam justo sapien.</p>
            
            <?php 
            /*================================================
                1.  PHONE AND EMAIL ADDRESS
            ================================================*/ ?>
            <ul class="contact-info list-inline text-center">
                <li class="tel"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><br /> <a href="%2b0800123456.html">0800 123 4567</a></li>
                <li class="email"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><br /> <a href="#">hello@yourdevstudio.com</a></li>
            </ul>
            
            <?php 
            /*================================================
                2.  MESSAGE INFO
            ================================================*/ ?>
            <?php $this->load->view('main/field/message_info'); ?>

            <?php 
            /*================================================
                2.  KONTAK FORM 
            ================================================*/ ?>
            <form id="contact-form" class="contact-form form" method="post" action="<?php echo $form_action?>">                    
                <div class="row text-center">
                    <div class="contact-form-inner col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                        <div class="row">                                                                                       
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group form_error_nama <?php if(form_error('nama') != '') { echo 'has-error'; } ?>">
                                <label class="sr-only" for="cname">Your name</label>
                                <input type="text" class="form-control" id="cname" name="nama" placeholder="Your name" minlength="2" required value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
<?php echo form_error('nama', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?>                            </div>                    
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group form_error_email <?php if(form_error('email') != '') { echo 'has-error'; } ?>">
                                <label class="sr-only" for="cemail">Email address</label>
                                <input type="email" class="form-control" id="cemail" name="email" placeholder="Your email address" required value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
<?php echo form_error('email', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?>                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group form_error_message <?php if(form_error('message') != '') { echo 'has-error'; } ?>">
                                <label class="sr-only" for="cmessage">Your message</label>
                                <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="12" required value="<?php echo set_value('message', isset($default['message']) ? $default['message'] : ''); ?>" /></textarea value="<?php echo set_value('message', isset($default['message']) ? $default['message'] : ''); ?>" />
<?php echo form_error('message', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?>                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                
                                <label for="captcha" class="control-label">Ketikkan jawaban dibawah</label>&nbsp;&nbsp;
                                <input type="text" id="captchaEquotation" value="<?php echo $captcha; ?>" disabled>
                                <input style="width:100%" type="text" autocomplete="off" placeholder="<?php echo isset($captcha_salah) ? 'Hasil Salah' : 'Silahkan Masukkan Jawaban Yang Benar'; ?>" name="login_equotation" class="form-control" value="" />
        
                            </div>
                             <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <button type="submit" class="btn btn-block btn-default btn-cta btn-cta-primary">Send Message</button>
                            </div>                           
                        </div><!--//row-->
                    </div>
                </div><!--//row-->
                <div id="form-messages"></div>
            </form><!--//contact-form-->
            <div style="clear:both"></div>
            <br />

            <?php 
            /*================================================
                3.  MAP
            ================================================*/ ?>
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                <div class="gmap-wrapper">
                    
    <!--//You need to embed your own google map below-->
                    <!--//Ref: https://support.google.com/maps/answer/144361?co=GENIE.Platform%3DDesktop&hl=en -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79444.64391671501!2d-0.21428374128957384!3d51.51972634746694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876045108e9cad3%3A0x6514817fa6d57c9!2sThe+Web+Kitchen!5e0!3m2!1sen!2suk!4v1469624353093" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div><!--//gmap-wrapper-->
            </div>
            <div style="clear:both"></div>
            <br />

        </div><!--//container-->
    </section><!--//contact-section-->
    