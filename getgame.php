<?php
//https://sportstream365.com/LiveFeed/GetGame?lng=vi&id=72786975&partner=24&_=1458751270218
$file = file_get_contents('https://sportstream365.com/LiveFeed/GetGame?id='.$_GET['id'].'&lng=vi&partner=24');
echo $file;
?>