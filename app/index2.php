<html>
<body>
 <form action="images2.php" method="post" target="_blank" id="put" autocomplete
 ="on">
 <input type="text" name="url">
</form>
</body>
<script type="text/javascript" src="jquery-1.11.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 $('form').css({position:'relative',margin:'0',
	 width:'90%'});
 $('form input').css({position:'relative',width:'90%',right:'-10%'});
 $('#a').css({width:'100%',height:'90%',allowTransparency:'true',
	 margin:'0'});

 $('input').keypress(function(event){
	  if(event.keyCode==13)
	  {
	   
       event.preventDefault();
       var p=document.getElementsByTagName('input')[0].value;
       console.log(p);

       document.getElementById('put').submit();
	  }
		
	});
 });
 </script>
</html>