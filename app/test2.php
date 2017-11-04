<html>
<head>
</head>
<?php
  error_reporting(E_ALL);
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
   if(preg_match("/&sa=\.*.*&ei=/i",$url)){
   	$url=preg_replace("/&sa=\.*.*&ei=\.*.*/i","",$url);
   }
   echo '<div id="thispageurl">url='.$url.'</div></br >';    //url!!!!!
    $lines = file($url);
    foreach ($lines as $line_num => $line) {
    	echo $line;
    }
   }catch (e $e){}
 ?>
<script src="jquery-1.11.2.js"></script>
<script type="text/javascript">
    var form=document.createElement('form');
    form.method="post";
    form.id="testform";
    form.action="test2.php";
    form.target="_blank";
    var input=document.createElement('input');
    input.type="text";
    input.name="url";
    input.id="testinput";


 $(document).ready(function(){
	 $('body').css({background:'#CCE8CC'});
	 $('a').on('click',function(event){
		   event.preventDefault();
		   var thispageurl=document.getElementById("thispageurl");

		      var a=this.getAttribute("href");
 		      a=decodeURIComponent(a);
              
              var thispageurl=document.getElementById("thispageurl").innerText;
              var googl=/www.google.com/i;
              var geturl2=/\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/;
              var testurl=/\.com|\.edu|\.gov|\.net|\.info|\.uk|\.cn|\.us|\.hk|\.tw|\.asia|.uk/i;
              var testhttp=/^http/i;
              
              if(googl.exec(thispageurl)){
            	  form.target="_self";
            	  var search=/search\?\.*.*q=/i;
            	  var urlq=/url\?q=/i
    		      if(search.exec(a)){
                       a="http://www.google.com"+a;
    		      }else if(urlq.exec(a)){
        		      var a=a.replace(/\.*.*http/i, "http");
        		      var a=a.replace(/&sa=\.*.*/i,"");
    		      }
   
              }else  if(testhttp.exec(a)){
                       
                  }
                else if(!testurl.exec(a)){
		        console.log('a='+a);
		       
		        var geturl=/[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/; 
		        var geturl2=/http....[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/;
		        
		        thispageurl=sfash(thispageurl);

		        var url=geturl.exec(thispageurl);
		        var urla=geturl2.exec(thispageurl);
		        console.log('url='+url);
		        console.log('urla='+urla);
		         console.log('thisurl='+thispageurl);
		        
		         function sfash(value){
		       	  var one=/^\//i;
		       	  var two=/\/$/i;
		       	  var value2=value.replace(one,"");
		       	  value=value2.replace(two,"");
		       	  return value;
		         }
		         
		        

		        var url3=thispageurl.replace('url=',"");
		        console.log('url3='+url3);
		        
		        var testhtm=/.htm|.html|.xhtml|.asp|.aspx|.php|.jsp|.shtml?$/i;
		        var hh=testhtm.exec(url3);
		        console.log('hh='+hh);

		        if(hh){
		        	var getback=/\/[-a-zA-Z0-9_]{0,62}\.[a-zA-Z0-9_]{0,62}?$|\/[-a-zA-Z0-9_]{0,62}\.[a-zA-Z0-9_]{0,62}\?\.*.*?$/i;
		            var url4=getback.exec(url3);
		            console.log('url4='+url4);
		            if(url4){
		           	 thispageurl=thispageurl.replace(url4,"");
		            }
		        }
		        
		        console.log('thispageurl='+thispageurl); 
		        
		        var url5=geturl2.exec(thispageurl);
		        console.log('url5='+url5);
		        if(url5==null){
		       	 url5=0;
		        }
		        var url6=thispageurl.replace('url=',"");
		        url6=url6.replace(url5[0],"");
		        url6=sfash(url6);
		        console.log('url6='+url6);
		      
		        url6=url6.replace(/\/.*.*/i,"");
		        var leng=url6.length;
		        console.log('url6.leng='+leng);
		        
		        a=sfash(a);
		        var a2=a.replace(/\/.*.*/i,"");
		        
		        console.log('a='+a);
		        console.log('a2='+a2);
		        console.log('url6='+url6);
		         

		       var yy=(a2.toString()==url6.toString());
		       if(url6=='topic'){
                  yy=true;
			       } 
		         console.log('yy='+yy);
		       if(yy)
		         {
			       var url=geturl.exec(thispageurl);
			       console.log('url='+url);
			       var httpstest=/https/i;
			       var httptest=/http/i;
			       if(httpstest.exec(thispageurl)){
		      	   if(httpstest.exec(a)){
		      	   var b=a.replace(/https.*\/\//i, 'https://'+url[0]+'/');
		      	    }else{
		      	    	 var slash=/^[/]\.*.*/i;
					       if(!slash.exec(a)){
			                     a='/'+a;
						       }
		      		   var b='https://'+url[0]+a;
		      	      }
		        }else  if(httptest.exec(a)){
		      		 var b=a.replace(/http.*\/\//i, 'https://'+url[0]+'/');
		      		  }else{
		      			var slash=/^[/]\.*.*/i;
					       if(!slash.exec(a)){
			                     a='/'+a;
						       }
		      			 var b='http://'+url[0]+a;
		            }
		     
		       console.log('b='+b);
		        a=b;
              }else{
            	  url7=thispageurl.replace('url=',"");
            	  url7=sfash(url7);
            	  console.log('url7='+url7);
            	  a=sfash(a);
            	  console.log('a='+a);
            	  b=url7+'/'+a;
            	  console.log('b='+b);
            	  a=b;
                  }
		 }

              if(input.value!=a){
		      input.value=a;
		      form.appendChild(input);
		      document.body.appendChild(form);
		      document.getElementById('testform').submit();
              }else{

                }

	   });

	   
    $('input').keypress(function(event){
  	  if(event.keyCode==13)
  	  {
         event.preventDefault();
         var p='';
         var num=document.getElementsByTagName('input').length;
         for(var i=0;i<num;i++){
             var name=document.getElementsByTagName('input')[i].getAttribute("class");
          if(name=="lst"){
           p=p+document.getElementsByTagName('input')[i].value;
          }
           var a='http://www.google.com/search?q='+p+'&hl=zh';
               a=encodeURI(a);
             }
          input.value=a;
	      console.log('a1='+a);
	      form.appendChild(input);
	      document.body.appendChild(form);
	      document.getElementById('testform').submit();
  	  }
  	});

  	$('.lsb').on('click',function(event){
  		event.preventDefault();
  		var p='';
        var num=document.getElementsByTagName('input').length;
        for(var i=0;i<num;i++){
            var name=document.getElementsByTagName('input')[i].getAttribute("class");
         if(name=="lst"){
          p=p+document.getElementsByTagName('input')[i].value;
         }
          var a='http://www.google.com/search?q='+p+'&hl=zh';
              a=encodeURI(a);
            }
         input.value=a;
	      console.log('a1='+a);
	      form.appendChild(input);
	      document.body.appendChild(form);
	      document.getElementById('testform').submit();
  	  	});
   });  
</script>
</html>