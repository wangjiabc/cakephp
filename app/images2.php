<?php
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
 }catch (e $e){}                            //���ò�ȫ����
/**
 * һ������ץȡͼƬ����
 *
 * @package default
 * @author  WuJunwei
 */
 echo 'url='.$url.'<br/>';
class download_image 
{
     
    public $save_path;                  //ץȡͼƬ�ı����ַ
 
    //ץȡͼƬ�Ĵ�С����(��λ:�ֽ�) ֻץ��size��������ƴ��ͼƬ
    public $img_size=0; 
 
    //����һ����̬����,���ڼ�¼����ץȡ���ĵĳ����ӵ�ַ,�����ظ�ץȡ       
    public static $a_url_arr=array();   
     
    /**
     * @param String $save_path    ץȡͼƬ�ı����ַ
     * @param Int    $img_size     ץȡͼƬ�ı����ַ
     */
    public function __construct($save_path,$img_size)
    {
        $this->save_path=$save_path;
        $this->img_size=$img_size;
    }
     
     
    /**
     * �ݹ�����ץȡ��ҳ������ҳ��ͼƬ�ķ���  ( recursive �ݹ�)
     *
     * @param   String  $capture_url  ����ץȡͼƬ����ַ
     * 
     */
    public function recursive_download_images($capture_url)
    {
        if (!in_array($capture_url,self::$a_url_arr))   //ûץȡ��
        {                         
            self::$a_url_arr[]=$capture_url;   //���뾲̬����
        } else   //ץȡ��,ֱ���˳�����
        {
            return;
        }        
         
        $this->download_current_page_images($capture_url);  //���ص�ǰҳ�������ͼƬ
         
        //��@���ε���Ϊץȡ��ַ�޷���ȡ���µ�warning����
        $content=@file_get_contents($capture_url); 
         
        //ƥ��a��ǩhref������?֮ǰ���ֵ�����
        $a_pattern = "|<a[^>]+href=['\" ]?([^ '\"?]+)['\" >]|U";   
        preg_match_all($a_pattern, $content, $a_out, PREG_SET_ORDER);
         
        $tmp_arr=array();  //����һ������,���ڴ�ŵ�ǰѭ����ץȡͼƬ�ĳ����ӵ�ַ
        foreach ($a_out as $k => $v) 
        {
            /**
             * ȥ���������е� ��'','#','/'���ظ�ֵ  
             * 1: �����ӵ�ַ��ֵ ���ܵ��ڵ�ǰץȡҳ���url, �����������ѭ��
             * 2: ������Ϊ''��'#','/'Ҳ�Ǳ�ҳ��,����Ҳ��������ѭ��,  
             * 3: ��ʱһ�������ӵ�ַ��һ����ҳ�л��ظ����ֶ��,�����ȥ��,���һ����ҳ������ظ�����)
             */
            if ( $v[1] && !in_array($v[1],self::$a_url_arr) &&!in_array($v[1],array('#','/',$capture_url) ) ) 
            {
                $tmp_arr[]=$v[1];
            }
        }
   
        foreach ($tmp_arr as $k => $v) 
        {            
            //������·����ַ
            if ( strpos($v, 'http://')!==false ) //���url����http://,����ֱ�ӷ���
            {
                $a_url = $v;
            }else   //����֤������Ե�ַ, ��Ҫ����ƴ�ճ����ӵķ��ʵ�ַ
            {
                $domain_url = substr($capture_url, 0,strpos($capture_url, '/',8)+1);
                $a_url=$domain_url.$v;
            }
 
            $this->recursive_download_images($a_url);
 
        }
         
    }  
     
       
    /**
     * ���ص�ǰ��ҳ�µ�����ͼƬ 
     *
     * @param   String  $capture_url  ����ץȡͼƬ����ҳ��ַ
     * @return  Array   ��ǰ��ҳ������ͼƬimg��ǩurl��ַ��һ������
     */
    public function download_current_page_images($capture_url)
    {
        $content=@file_get_contents($capture_url);   //����warning����
 
        //ƥ��img��ǩsrc������?֮ǰ���ֵ�����
        $img_pattern = "|<img[^>]+src=['\" ]?([^ '\"?]+)['\" >]|U";   
        preg_match_all($img_pattern, $content, $img_out, PREG_SET_ORDER);
 
        $photo_num = count($img_out);
        //ƥ�䵽��ͼƬ����
        echo '<h1>'.$capture_url . "���ҵ� " . $photo_num . " ��ͼƬ</h1>";
        foreach ($img_out as $k => $v) 
        {
            $this->save_one_img($capture_url,$v[1]);
        }
    }
 
 
    /**
     * ���浥��ͼƬ�ķ��� 
     *
     * @param String $capture_url   ����ץȡͼƬ����ҳ��ַ
     * @param String $img_url       ��Ҫ�����ͼƬ��url
     * 
     */
    public function save_one_img($capture_url,$img_url)
    {        
        //ͼƬ·����ַ
        if ( strpos($img_url, 'http://')!==false ) 
        {
            // $img_url = $img_url;
        }else  
        {
            $domain_url = substr($capture_url, 0,strpos($capture_url, '/',8)+1);
            $img_url=$domain_url.$img_url;
        }           
        $pathinfo = pathinfo($img_url);    //��ȡͼƬ·����Ϣ        
        $pic_name=$pathinfo['basename'];   //��ȡͼƬ������
        if (file_exists($this->save_path.$pic_name))  //���ͼƬ����,֤���Ѿ���ץȡ��,�˳�����
        {
//            echo $img_url . '<span style="color:red;margin-left:80px">��ͼƬ�Ѿ�ץȡ��!</span><br/>'; 
            return;
        }                
        //��ͼƬ���ݶ���һ���ַ���
        $img_data = @file_get_contents($img_url);   //���ε���ΪͼƬ��ַ�޷���ȡ���µ�warning����
        if ( strlen($img_data) > $this->img_size )   //����size�����ƴ��ͼƬ
        {

           $img_size = file_put_contents($this->save_path.$pic_name, $img_data);
           echo '<img src="tmp/'.$pic_name.'"><br />';
            if ($img_size)
            {
                echo $img_url . '<span style="color:green;margin-left:80px">ͼƬ����ɹ�!</span><br/>';
            } else
            {
                echo $img_url . '<span style="color:red;margin-left:80px">ͼƬ����ʧ��!</span><br/>';
            }
        } else
        {
            echo $img_url . '<span style="color:red;margin-left:80px">ͼƬ��ȡʧ��!</span><br/>';
        } 
//        unlink(dirname(__FILE__).'/tmp/'.$pic_name);
    } 
} // END
 
set_time_limit(120);     //���ýű������ִ��ʱ��  ����������� 
$filename=dirname(__FILE__).'/tmp/';
if(!file_exists($filename)){
	mkdir($filename,0777);
}
$download_img=new download_image($filename,0);   //ʵ��������ͼƬ����
$download_img->recursive_download_images($url);      //�ݹ�ץȡͼƬ����

//$download_img->download_current_page_images($_POST['capture_url']);     //ֻץȡ��ǰҳ��ͼƬ����
 
?>