<?php
global $sTemplateURL;
$sTemplateURL = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="shortcut icon" href="<?php echo $sTemplateURL ?>/images/favicon.ico">
        <link href="<?php echo $sTemplateURL ?>/css/swiper.min.css" rel="stylesheet">
        <link href="<?php echo $sTemplateURL ?>/css/styles.min.css" rel="stylesheet">
        <title><?php
        wp_title('|', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
        echo " | $site_description";
        ?></title>
        <script>var base_url = "<?php echo get_site_url() ?>"</script>
        <?php wp_head(); ?>
        <link href="<?php echo $sTemplateURL ?>/style.css" rel="stylesheet">
        <?php get_template_part('seo-general') ?>

    </head>
    <body <?php body_class(); ?>>
        <a href="#top" title="Back to top" class="back-to-top"><i class="fa fa-arrow-up"></i></a>
        <header>
            <div class="container">
                <nav class="navbar navbar-top">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse-top" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-collapse-top">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'   => 'top-menu',
                            'menu_class' => 'nav navbar-nav',
                            'container'  => '',
                            'walker' => new wp_bootstrap_navwalker()
                        ));
                        ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
                <div class="wr-slogan">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <h1 class="primary-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo $sTemplateURL ?>/images/logo.png" atl="<?php bloginfo('name') ?>" width="200">
                                </a>
                            </h1>
                        </div>
                        <div class="col-md-9 col-sm-9 mr-t-13">
                            <?php dynamic_sidebar('dynamic_headerbanner') ?>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-main">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse-main" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-collapse-main">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'   => 'main-menu',
                            'menu_class' => 'nav navbar-nav',
                            'container'  => '',
                            'walker' => new wp_bootstrap_navwalker()
                        ));
                        ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>

                <?php dynamic_sidebar('dynamic_afterheaderbanner') ?>
                
            </div>
        </header>
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php dynamic_sidebar('dynamic_bodybanner1') ?>
                    </div>
                </div>
                <div class="row visible-lg ad-2-col">
                    <div class="col-md-6">
                        <?php dynamic_sidebar('dynamic_bodybanner2') ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php dynamic_sidebar('dynamic_bodybanner3') ?>
                    </div>
                </div>