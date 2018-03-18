<script>
	$(window).resize(function() {
		if(getWidth() > 990){
			var widthContent = getWidth() - 345;
		}
		else{
			var widthContent = getWidth()-30;
		}
		$('#id_video').attr("width",widthContent);
		$('#id_video').attr('height', widthContent * 320 / 580);
//		if(getWidth() > 1530){
//	  		$('#id_video').attr('width', '1160px'); 
//	  		$('#id_video').attr('height', '653px');
//	  	}
//		else if(getWidth() > 1335){
//	  		$('#id_video').attr('width', '970px');
//	  		$('#id_video').attr('height', '546px');
//	  	}
//		else if(getWidth() > 1145){
//	  		$('#id_video').attr('width', '780px');
//	  		$('#id_video').attr('height', '439px'); 
//	  	}
//		else if(getWidth() > 885){
//	  		$('#id_video').attr('width', '580px');
//	  		$('#id_video').attr('height', '326px'); 
//	  	} 
	});
	
	$(document).ready(function() {
		if(getWidth() > 990){
			var widthContent = getWidth() - 345;
		}
		else{
			var widthContent = getWidth()-30;
		}
		$('#id_video').attr("width",widthContent);
		$('#id_video').attr('height', widthContent * 320 / 580);
//		
//		if(getWidth() > 1530){
//	  		$('#id_video').attr('width', '1160px'); 
//	  		$('#id_video').attr('height', '647px');
//	  	}
//		else if(getWidth() > 1335){
//	  		$('#id_video').attr('width', '970px');
//	  		$('#id_video').attr('height', '540px');
//	  	}
//		else if(getWidth() > 1145){
//	  		$('#id_video').attr('width', '780px');
//	  		$('#id_video').attr('height', '433px'); 
//	  	}
//		else if(getWidth() > 885){
//	  		$('#id_video').attr('width', '580px');
//	  		$('#id_video').attr('height', '320px'); 
//	  	} 
	});
</script>
<?php
	if(isset($videoId)){
		?>
		<div class="news_content">
		<iframe id="id_video" width="770px" height="380px"
			src="https://www.youtube.com/embed/<?php echo $videoId;?>"
			frameborder="0" allowfullscreen></iframe>
		</div>
		<?php 
	}
?>
<script>
	var sharebutton_is_horizontal = true; 
	document.write('<script src="js/share4.js"></scr' + 'ipt>'); 
	document.write("<div style='display: none'>");</script>
<script>document.write("</div>");</script>