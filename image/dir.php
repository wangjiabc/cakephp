<?php
$dir=dirname(__FILE__).'/tmp/';
if(file_exists($dir)){
echo 'tmp is exists<br />';
$handler = opendir($dir);
while (($filename = readdir($handler)) !== false) {//���ʹ��!==����ֹĿ¼�³��������ļ�����0�������
	if ($filename != "." && $filename != "..") {
		$files[] = $filename ;
	}
}

closedir($handler);
 
//��ӡ�����ļ���
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
