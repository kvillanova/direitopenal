<?php
if(!isset($title)) $title=NULL;
if(!isset($desc)) $desc=NULL;

$url = "http://" . $_SERVER['HTTP_HOST'] . '/';
if($_SERVER['HTTP_HOST']==='localhost') $url .= 'direitopenal/';

if(!isset($responsive)) $responsive = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
if(!isset($og_img)) $og_img = $url . "ogrel/site.jpg";

$og = PHP_EOL . <<<OG
<meta property="og:image" content="{$og_img}" />
<meta property="og:title" content="{$title}" />
<meta property="og:description" content="{$desc}" />
<meta property="og:url" content="{$url}" />
<meta property="og:type" content="website" />
OG;

echo <<<O
{$responsive}
<meta charset="UTF-8">{$og}
<title>{$title}</title>
O;
echo PHP_EOL;

include "rel.php";
?>