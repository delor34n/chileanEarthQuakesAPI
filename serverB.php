<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST["url"])){
			
			$ch = curl_init($_POST["url"]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			$content = curl_exec($ch);
			curl_close($ch);

			$cleanContent = getBetween($content,"<body>","</body>");

			echo $cleanContent;
		} else {
			echo "false";
		}
	} else {
		echo "false";
	}

	/*
	* @author: http://tonyspiro.com/using-php-to-get-a-string-between-two-strings/
	*/
	function getBetween($content,$start,$end){
	    $r = explode($start, $content);
	    if (isset($r[1])){
	        $r = explode($end, $r[1]);
	        return $r[0];
	    }
	    return '';
	}
?>