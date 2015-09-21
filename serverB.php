<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST["url"])){
			
			$ch = curl_init($_POST["url"]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			$content = curl_exec($ch);
			curl_close($ch);

			echo buildJSON($content);
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

	function buildJSON($content){
		$table = getBetween($content,"<tbody>","</tbody>");
		$body = getBetween($content,"<body>","</body>");
		$body = str_replace('<a href="/events/', '<a href="http://www.sismologia.cl/events/', $body);

		$dom = new DomDocument;
		$dom->loadHTML($table);
		$xpath = new DomXPath($dom);
		$dom->preserveWhiteSpace = false;

		// collect header names
		$headerNames = array();
		foreach ($xpath->query('//th') as $node) {
		    $headerNames[] = $node->nodeValue;
		}

		// collect data
		$data = array();
		foreach ($xpath->query('//tr') as $node) {
		    $rowData = array();
		    foreach ($xpath->query('td', $node) as $cell) {
		        	$rowData[] = $cell->nodeValue;
		    }

		    if($rowData)
		    	$data[] = array_combine($headerNames, $rowData);
		}

		return json_encode(
			array(
			    "json" => $data,
			    "html" => $body,
			)
		);
	}
?>