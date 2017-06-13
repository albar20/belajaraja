<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title><?php echo $this->setting->website_name ?></title>
   <style type="text/css">
    /*===========================================
        1.  LOGO WRAPPER
        2.  THANKS TEXT 
    ===========================================*/
    a {color: #4A72AF;}
    body, #header h1, #header h2, p {margin: 0; padding: 0;}
    .no_float{clear: both;}
    .text-center{text-align:center;}
    .text-left{text-align:left;}
    .text-right{text-align:right;}
    .bold{ font-weight: bold }
    .font-color{
        color: #3E3E3E;
    }
    #perusahaan_detail td{
        padding: 5px 20px;

    }
    
    /*===========================================
        1.  LOGO WRAPPER
    ===========================================*/
    .logo_wrapper {
        margin: 0 auto;
        width: 440px;
        text-align: center;
    }
    .logo_wrapper img {
        width: 300px;
    }
    .logo_wrapper h1 {
        float: left;
        font-family: "Lucida Grande","Lucida Sans","Lucida Sans Unicode",sans-serif;
        font-size: 50px !important;
        color: #ffcf29;
    }
    .logo_wrapper p {
        font-style: italic;
        text-align: center;
        color: #ffcf29;
        margin-top: 10px;
    }
    
    
    /*===========================================
        2.  THANKS TEXT
    ===========================================*/
    .thank_wrapper .thanks-text{
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 10px;
    }
    .status{
        text-transform: capitalize;
        font-weight: bold;
    }
    .box-notification{
        background-color: #03F;
        color: #FFF;
        padding: 20px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
    }
    
    /*===========================================
        3.  RINCIAN PESANAN
    ===========================================*/
    .sales_id{
        display: inline-block;
        width: 130px;
        margin: 5px 0;
    }
    .total-harga{
        color: #FFF;
    }
    
    
    /*===========================================
        4.  CARA PEMBAYARAN
    ===========================================*/
    #cara-pembayaran ol{
        padding-left: 20px;
    }
    #cara-pembayaran ol li{
        margin-top: 20px;
    }
    .konfirmasi-button{
        background-color: #090;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #fff;
        display: block;
        margin: 0 auto;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        width: 220px;   
    }
    
    /*===========================================
        5.  FOOTER
    ===========================================*/
    #footer ul{
        margin: 0;
        padding: 0;
    }
    #footer ul li{
        list-style: none;
        float: left;
        margin-left: 10px;
        margin-right: 10px;
    }
    .footer-inner .social-media{
        display: block;
        width: 280px;
        margin: 0 auto;
        
    }
    .copyright{
        margin: 20px auto 10px;
        text-align: center;
        color: #000;
    }

   </style>
</head>

<body>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ccc"><tr><td>
    
    
        
    <table id="main" width="600" align="center" cellpadding="0" cellspacing="15" bgcolor="ffffff" class="font-color">
        <tr>
            <td>
                <table id="header" cellpadding="20" cellspacing="0" align="center" bgcolor="">
                    <tr>
                        <td width="570" bgcolor="#ccc">
                            <div class="logo_wrapper"> 
                                    <img src="<?php echo base_url() ?>uploads/logo/<?php echo $this->setting->website_logo; ?>" alt="logo ?php echo $this->setting->website_name ?>" />                           
                            </div>
                        </td>
                    </tr>
                </table><!-- header -->
                <table id="" cellpadding="20" cellspacing="0" align="center" bgcolor="#F3F3F3">
                    <tr>
                        <td width="570" bgcolor="">
                            <div class="thank_wrapper"> 
                                <p class="thanks-text font-color">Welcome to, <?php echo $this->setting->website_name; ?></p>
                                <p>Thanks for joining <a href="<?php echo site_url() ?>">Us</a></p>
                                <br />
                                <p><a href="<?php echo site_url() . 'confirm_register/'.$random_hash; ?>">Activate My Account</a></p>
                                <br />
                                <p>
                                    If link in above is not working, just copy paste the code into your browser url
                                </p>
                                <p>
                                    <?php echo site_url() . 'confirm_register/'.$random_hash; ?>
                                </p>
                                <br/>
                                <p><span class="bold font-color">Your Email</span> : <?php echo $email ?></p>
                                <br/>
                            </div>
                        </td>
                    </tr>
                </table>
                <table id="perusahaan_detail" cellpadding="20" cellspacing="0" align="center" bgcolor="#F3F3F3">
                    <tr>
                        <td width="150" bgcolor="">
                            <span class="bold font-color">Nama Perusahaan </span>
                        </td>
                        <td width="50">
                            :
                        </td>
                        <td width="300" bgcolor="">
                            <?php if( $this->setting->nama_perusahaan !='' ): ?>
                                <?php echo $this->setting->nama_perusahaan ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" bgcolor="">
                            <span class="bold font-color">Alamat Perusahaan </span>
                        </td>
                        <td width="50">
                            :
                        </td>
                        <td width="300" bgcolor="">
                            <?php if( $this->setting->alamat_perusahaan !='' ): ?>
                                    <?php echo $this->setting->alamat_perusahaan ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" bgcolor="">
                            <span class="bold font-color">Email Perusahaan </span>
                        </td>
                        <td width="50">
                            :
                        </td>
                        <td width="300" bgcolor="">
                            <?php if( $this->setting->email_perusahaan !='' ): ?>
                                <?php echo $this->setting->email_perusahaan ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" bgcolor="">
                            <span class="bold font-color">Telepon Perusahaan </span>
                        </td>
                        <td width="50">
                            :
                        </td>
                        <td width="300" bgcolor="">
                            <?php if( $this->setting->telepon_perusahaan !='' ): ?>
                                <?php echo $this->setting->telepon_perusahaan ?></p>
                            <?php endif; ?>
                            <br/>
                            <br/>
                        </td>
                    </tr>
                </table>
                <table id="footer" cellpadding="10" cellspacing="0" align="center" bgcolor="#ccc">
                    <tr>
                        <td width="570" bgcolor="">
                            <div class="footer-inner"> 
                                <div class="social-media">
                                    <br/>
                                    <ul>
                                        <li>
                                            <a target="_blank" href="<?php echo $this->setting->facebook ?>">
                                                <img class="kmButtonBlockIcon" width="48" style="width:48px; max-width:48px; 
                                                    display:block;" src="<?php echo site_url() ?>uploads/social_media/facebook_48.png" 
                                                    alt="Button Text">
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php echo $this->setting->twitter ?>">
                                                <img class="kmButtonBlockIcon" width="48" style="width:48px; max-width:48px; 
                                                    display:block;" src="<?php echo site_url() ?>uploads/social_media/twitter_48.png" 
                                                    alt="Button Text">
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php echo $this->setting->google ?>">
                                                <img class="kmButtonBlockIcon" width="48" style="width:48px; max-width:48px; 
                                                    display:block;" src="<?php echo site_url() ?>uploads/social_media/google.png" 
                                                    alt="Button Text">
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?php echo $this->setting->instagram ?>">
                                                <img class="kmButtonBlockIcon" width="48" style="width:48px; max-width:48px; 
                                                    display:block;" src="<?php echo site_url() ?>uploads/social_media/instagram_48.png" 
                                                    alt="Button Text">
                                            </a>
                                        </li>
                                        
                                    </ul>
                                    <div class="no_float"></div>
                                </div>
                                <p class="copyright"> Copyrights <?php echo $this->setting->website_name ?>. All Rights Reserved.</p>
                                <div class="no_float"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</td></tr></table><!-- wrapper -->

</body>
</html>

</div>
</body>
</html>