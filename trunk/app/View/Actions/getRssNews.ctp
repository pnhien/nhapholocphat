<?php 
	if(isset($page)){
		echo $page;
	}
	echo "<br>";
	if(isset($rssNewsUpdated)){
		foreach ($rssNewsUpdated as $rssUrl)
		echo $rssUrl . "<br>";
	}

?>