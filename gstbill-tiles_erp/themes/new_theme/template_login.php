<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>    
        <title><?= $this->config->item('site_title'); ?> | <?= $this->config->item('site_powered'); ?></title>    	
        <?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
        <link href="<?= $theme_path; ?>/images/logo-fav.png" rel="shortcut icon">
		 
        <link href="<?= $theme_path; ?>/css/style.default.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="signin">
    <section>
            
            <div class="panel panel-signin panel0">
                <div class="panel-body1">
                <div class="paper-wrap bevel tlbr m-0">
                  <div id="paper-top">
                   <div class="row">
                    <div class="col-md-12">
                    <div class="logo text-center">
                        <img src="<?= $theme_path; ?>/images/logo-login.png" alt="Billing Software" >
                    </div>
                    </div>
                   </div>
                  </div>
                 </div>
                    
                   
                    <?php 
					if(isset($_GET['login']) && !empty($_GET['login']))
					{
					?>
                    <div class="alert alert-danger">
                        <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Sorry!</strong> Incorrect Login Credentials !
                    </div>
                    <?php }?>
                   <?php echo $content;?>
                </div><!-- panel-body -->
                
            </div><!-- panel -->
            
        </section>


        <script src="<?= $theme_path; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?= $theme_path; ?>/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?= $theme_path; ?>/js/bootstrap.min.js"></script>
        <script src="<?= $theme_path; ?>/js/modernizr.min.js"></script>
        <script src="<?= $theme_path; ?>/js/pace.min.js"></script>
        <script src="<?= $theme_path; ?>/js/retina.min.js"></script>
        <script src="<?= $theme_path; ?>/js/jquery.cookies.js"></script>

        <script src="<?= $theme_path; ?>/js/custom.js"></script>

    </body>
</html>
