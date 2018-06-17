<?php
//$file = @file_get_contents('http://sportstream365.com/LiveFeed/GetLeftMenuShort?sports=1&lng=vi&partner=24');

/*$url = 'http://linktructiepbongda.com/ttbdWS.asmx/getAllurl';
$data = ['pageID' => 1];
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json",
        //'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
        //'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$file = file_get_contents($url, false, $context);*/

$url = 'http://mybongda.com/mbd/?t=football';
$options = array(
    'http' => array(
        // 'header'  => "Content-type: application/json",
        //'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'GET',
        // 'content' => json_encode($data)
        //'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$file = file_get_contents($url, false, $context);

if ($file) {
    echo "Thoi gian cap nhat ".gmdate('Y-m-d H:i:s')."<br>";
    echo 'Trann dau da duoc cap nhat, data:'.file_put_contents(dirname(__FILE__).'/LiveFeed.html', $file);
} else {
    echo "Error<br>";
}
?>
