        <?php global $sTemplateURL; ?>

        <div id="footer">
        
        </div>
        <div class="footer-bot">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'   => 'top-menu',
                            'menu_class' => 'nav navbar-footer',
                            'container'  => '',
                            'walker' => new wp_bootstrap_navwalker()
                        ));
                        ?>
                        <?php
                        wp_nav_menu(array(
                            'theme_location'   => 'main-menu',
                            'menu_class' => 'nav navbar-footer',
                            'container'  => '',
                            'walker' => new wp_bootstrap_navwalker()
                        ));
                        ?>
                    </div>
                </div>
            </div>

            <center><?php dynamic_sidebar('dynamic_copyright') ?></center>
        </div>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="<?php echo $sTemplateURL ?>/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $sTemplateURL ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $sTemplateURL ?>/js/materialize.js"></script>
        <script type="text/javascript" src="<?php echo $sTemplateURL ?>/js/swiper.js"></script>
        <script type="text/javascript" src="<?php echo $sTemplateURL ?>/js/script.js"></script>
        <!--<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-64337226-1', 'auto');
          ga('send', 'pageview');
        </script>-->
        <!--
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=1603003013277192";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        -->
        <?php wp_footer() ?>
        <div id="divAdLeft" style="position: fixed; top: 0; left: 10px;" class="visible-lg">
            <?php dynamic_sidebar('dynamic_leftbanner') ?>
        </div>
        <div id="divAdRight" style="position: fixed; top: 0; right: 10px;" class="visible-lg">
            <?php dynamic_sidebar('dynamic_rightbanner') ?>
        </div>
    </body>
</html>