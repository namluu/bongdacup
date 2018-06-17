<?php get_header() ?>
<?php
global $sTemplateURL;
$thumUrl = $sTemplateURL.'/images/no-image.png';
?>
<div id="main">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<img class="media-object center-block" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>">
        		<div style="width: 500px; text-align: center; margin: 0 auto; font-size: 18px;">
        		<p>Trang này không tồn tại. Xin lỗi vì sự bất tiện này. Thử tìm kiếm nội dung khác nhé</p>
        		<ul class="list-unstyled">
        		<?php
				$args = array(
					'numberposts' => 10,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' =>'',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true
				);

				$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
				foreach( $recent_posts as $recent ){
					echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
				}
				wp_reset_query();
				?>	
        		</ul>
        		</div>
        	</div>
        </div>
    </div>
</div>
<br><br><br>
<?php get_footer() ?>