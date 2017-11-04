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
/**
 * 文件下载
 *
**/

//downloads('https://sm.myapp.com/original/Compression/7z1604-x64.exe');

try {
	$post=$_POST['url'];
	if(preg_match("/http:\/\//i",$post)){
		$url1=$post;
	}else {
		$url1='http://'.$post;
	}

	if(preg_match("/http:\/\//i",$url1)){
		preg_match('/http:\/\/\.*.*/i',$url1,$url2);
		$url=$url2[0];

	}
	if(preg_match("/https:\/\//i",$url1)){
		preg_match('/https:\/\/\.*.*/i',$url1,$url2);
		$url=$url2[0];
	}
}catch (e $e){}                            //设置补全域名
/**
 * 一个用于抓取图片的类
 *
 * @package default
 * @author  WuJunwei
 */

class download_image
{
	 
	public $save_path;                  //抓取图片的保存地址

	//抓取图片的大小限制(单位:字节) 只抓比size比这个限制大的图片
	public $img_size=0;

	//定义一个静态数组,用于记录曾经抓取过的的超链接地址,避免重复抓取
	public static $a_url_arr=array();
	 
	/**
	 * @param String $save_path    抓取图片的保存地址
	 * @param Int    $img_size     抓取图片的保存地址
	 */
	public function __construct($save_path,$img_size)
	{
		$this->save_path=$save_path;
		$this->img_size=$img_size;
	}
	 


	/**
	 * 保存单个图片的方法
	 *
	 * @param String $capture_url   用于抓取图片的网页地址
	 * @param String $img_url       需要保存的图片的url
	 *
	 */
	public function save_one_img($img_url)
	{
		//图片路径地址
		if ( strpos($img_url, 'http://')!==false )
		{
			// $img_url = $img_url;
		}
		
		$pathinfo = pathinfo($img_url);    //获取图片路径信息
		$pic_name=$pathinfo['basename'];   //获取图片的名字
		if (file_exists($this->save_path.$pic_name))  //如果图片存在,证明已经被抓取过,退出函数
		{
			//            echo $img_url . '<span style="color:red;margin-left:80px">该图片已经抓取过!</span><br/>';
			return;
		}
		//将图片内容读入一个字符串
		$img_data = @file_get_contents($img_url);   //屏蔽掉因为图片地址无法读取导致的warning错误
		if ( strlen($img_data) > $this->img_size )   //下载size比限制大的图片
		{

			$img_size = file_put_contents($this->save_path.$pic_name, $img_data);
			echo '<img src="/f2/image/tmp/'.$pic_name.'"><br />';
			if ($img_size)
			{
				echo $img_url . '<span style="color:green;margin-left:80px">图片保存成功!</span><br/>';
			} else
			{
				echo $img_url . '<span style="color:red;margin-left:80px">图片保存失败!</span><br/>';
			}
		} else
		{
			echo $img_url . '<span style="color:red;margin-left:80px">图片读取失败!</span><br/>';
		}
		//        unlink(dirname(__FILE__).'/tmp/'.$pic_name);
		return $pic_name;
	}
} // END

set_time_limit(120);     //设置脚本的最大执行时间  根据情况设置
$filename=dirname(__FILE__).'/tmp/';
if(!file_exists($filename)){
	mkdir($filename,0777);
}
$download_img=new download_image($filename,0);   //实例化下载图片对象

$file=$download_img->save_one_img($url);     //只抓取当前页面图片方法

echo "<br/>".$_SERVER['HTTP_HOST']."/tmp/".$file;

?>