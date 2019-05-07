<?php 
// server protocol
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$url = $protocol.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$array = explode('/', $url);
array_pop($array);

$base_url = implode('/', $array);
echo $base_url;die;
 ?>