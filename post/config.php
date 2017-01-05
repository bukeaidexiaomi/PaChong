<?php

$postStatus     = "publish"; 			
$randomPostTime = 0;
$translateSlug  = false;			
$timeZoneOffset = 16;    				
$pingAfterPost  = false;  				
$postAuthor     = 1;    				
$secretWord     = "yht123hito"; 			
function strtr_words($str)
{
$words=array();
$key_list = file("word.txt");
foreach($key_list as $k=>$v)
{
$str_data = explode(",",$v);
$w1=trim($str_data[0])." ";
$w2=trim($str_data[1])." ";
$words+=array("$w1"=>"$w2","$w2"=>"$w1");
}
return strtr($str,$words);
}
?>
