<form class="navbar-form navbar-right" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group">
        <input type="text" class="form-control input-search" placeholder="Search" name="s" id="s" value="<?php echo get_search_query(); ?>">
        <button type="submit" class="btn btn-search" id="searchsubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <!--<input type="hidden" value="post" name="post_type" id="post_type" />-->
        <input type="hidden" name="post_type" value="products">
    </div>
</form>
