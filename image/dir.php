<?php
$dir=dirname(__FILE__).'/tmp/';
if(file_exists($dir)){
echo 'tmp is exists<br />';
$handler = opendir($dir);
while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
	if ($filename != "." && $filename != "..") {
		$files[] = $filename ;
	}
}

closedir($handler);
 
//打印所有文件名
foreach ($files as $value) {
	if(unlink($dir.$value)){
//	    echo $value."delete.<br />";
	}else{
		echo $value."delete error<br />";
	}
 }
}else{
 echo 'tmp is not exists</br />';
}
?>
