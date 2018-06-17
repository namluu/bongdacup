<?php

$url = 'http://www.goalhd24.com/';
$options = array(
    'http' => array(
        'method'  => 'GET',
    )
);
$context  = stream_context_create($options);
$file = file_get_contents($url, false, $context);

if ($file) {
    echo "Thời gian cập nhật ".gmdate('Y-m-d H:i:s')."<br>";
    echo 'Đã lấy thông tin website '.$url.' về, data:'.file_put_contents(dirname(__FILE__).'/web-content.html', $file);
} else {
    echo "Error<br>";
}
?>
