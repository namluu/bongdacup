<?php 
global $sTemplateURL;
$thumUrl = $thumMediumUrl = $sTemplateURL.'/images/no-image-box.png';
$list = [];
$query = new WP_Query( array( 'category_name' => 'binh-luan', 'posts_per_page' => 10 ) );
while ( $query->have_posts() ) {
    $query->the_post();
    if (has_post_thumbnail()) {
        $attachs = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb-home');
        if ($attachs) {
            $thumUrl = reset($attachs);
        }
        $mediumAttachs = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
        if ($mediumAttachs) {
            $thumMediumUrl = reset($mediumAttachs);
        }
    }
    $list[] = [
        'image_small' => $thumUrl,
        'image_big' => $thumMediumUrl,
        'title' => get_the_title(),
        'link' => get_the_permalink(),
        'description' =>get_the_excerpt()
    ];
    wp_reset_postdata();
    $thumUrl = $thumMediumUrl = $sTemplateURL.'/images/no-image-box.png';
}
?>
<div id="swiper">
    <div class="swiper-container gallery-top swiper-container-horizontal">
        <div class="swiper-wrapper">
            <?php foreach($list as $item): ?>
            <div class="swiper-slide">
                <a href="<?php echo $item['link'] ?>">
                    <div class="large_image">
                        <img src="<?php echo $item['image_big'] ?>" width="100%">
                    </div>
                    <div class="info">
                        <h4><?php echo $item['title'] ?></h4>
                        <p class="summary"><?php echo $item['description'] ?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <div class="swiper-container gallery-thumbs swiper-container-vertical">
        <div class="swiper-wrapper">
            <?php foreach($list as $item): ?>
            <div class="swiper-slide">
                <div class="thumb">
                    <img src="<?php echo $item['image_big'] ?>" alt="<?php echo $item['title'] ?>">
                </div>
                <p><?php echo $item['title'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>