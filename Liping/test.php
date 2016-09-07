<?php
$filename=NULL;  
if(!empty($_GET['filename'])){
	$filename='./upload/'.$_GET['filename'];
    echo $filename;
}
$file=fopen($filename,'r');
echo $file['type'];
?>