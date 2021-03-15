<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: text/xml");
$location = file_get_contents('./location.xml');
echo($location);
?>