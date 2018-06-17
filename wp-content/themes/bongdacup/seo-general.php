<?php 

// default
$title = 'TrucTiepBongHD - xem bong da online';
$desc = 'TrucTiepBongHD - xem truc tiep bong da, xem bongda, bong da, link nhanh bongda, xem bong.';
$key = 'BongdaHD, bong da, bóng đá, bong da, ca do bong da, xem bongda online';
$smallImage = get_template_directory_uri().'/screenshot.jpg';
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

/*if ($product) {
    $title = strip_tags($product->post->post_title) . ' - ' . $title;
    $desc = strip_tags($title) .'. '. strip_tags($product->post->post_excerpt);
    $key = $key .', '. strip_tags($product->get_tags());
    if (has_post_thumbnail()) {
        $arrayThumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
        $smallImage = reset($arrayThumbs);
    }
    //$url = get_permalink();
} elseif (is_single()) {
    $title = get_the_title();
    if (has_post_thumbnail()) {
        $arrayThumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
        $smallImage = reset($arrayThumbs);
    }
} else {
    $title = $title . ' - Sản phẩm làm trắng răng Hoa Kỳ';
}*/

?>

<meta name="description" content="<?php echo $desc; ?>" />
<meta name="keywords" content="<?php echo $key; ?>" />
<meta name="robots" content="index,follow" />

<meta name="author" content="bongdacup.com">
<meta name="copyright" content="bongdacup.com">
<meta http-equiv="content-language" content="vi" />
<link rel="alternate" href="http://bongdacup.com" hreflang="vi-vn" />

<!-- Open Graph Data - FB -->
<meta property="fb:app_id" content="505851136287676" />
<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="<?php echo $smallImage ?>"/>
<meta property="og:site_name" content="<?php echo $title; ?>"/>
<meta property="og:description" content="<?php echo $desc; ?>"/>
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="<?php echo $url ?>" />

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117911058-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117911058-1');
</script>