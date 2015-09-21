<?php

	$table = '<tr class="impar"><th>Fecha Local</th><th>Lugar</th><th>Magnitud</th></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/erb_21-2111-29L.S201509.html" target="centro">2015/09/21 18:11:29</a></td><td>50 km al SO de San Pedro de Atacama</td><td>3.3 Ml</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-2100-00L.S201509.html" target="centro">2015/09/21 17:59:40</a></td><td>89 km al O de La Higuera</td><td>4.0 Ml</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-2055-26L.S201509.html" target="centro">2015/09/21 17:55:26</a></td><td>16 km al O de Punitaqui</td><td>3.7 Ml</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-2050-56L.S201509.html" target="centro">2015/09/21 17:50:53</a></td><td>46 km al NO de Canela Baja</td><td>3.6 Ml</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-2037-20L.S201509.html" target="centro">2015/09/21 17:37:29</a></td><td>62 km al SO de Los Vilos</td><td>3.4 Ml</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-2024-34L.S201509.html" target="centro">2015/09/21 17:24:34</a></td><td>46 km al O de Los Vilos</td><td>4.4 Ml</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-2015-22L.S201509.html" target="centro">2015/09/21 17:15:21</a></td><td>43 km al SO de Los Vilos</td><td>3.6 Ml</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-2005-43L.S201509.html" target="centro">2015/09/21 17:05:42</a></td><td>44 km al SO de Los Vilos</td><td>4.0 Ml</td></tr>
<tr class="par s_sensible"><td><a href="/events/sensibles/2015/09/21-1956-07L.S201509.html" target="centro">2015/09/21 16:56:09</a></td><td>18 km al NO de Los Vilos</td><td>6.0 Mw</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-1908-06L.S201509.html" target="centro">2015/09/21 16:08:05</a></td><td>25 km al SO de Canela Baja</td><td>4.5 Ml</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-1855-38L.S201509.html" target="centro">2015/09/21 15:57:39</a></td><td>51 km al NO de Canela Baja</td><td>4.0 Ml</td></tr>
<tr class="impar"><td><a href="/events/sensibles/2015/09/21-1855-37L.S201509.html" target="centro">2015/09/21 15:55:34</a></td><td>42 km al NO de Canela Baja</td><td>4.1 Ml</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-1847-08L.S201509.html" target="centro">2015/09/21 15:47:06</a></td><td>17 km al NO de Los Vilos</td><td>4.6 Ml</td></tr>
<tr class="impar s_sensible"><td><a href="/events/sensibles/2015/09/21-1836-08L.S201509.html" target="centro">2015/09/21 15:36:53</a></td><td>46 km al NO de Canela Baja</td><td>5.8 Mw</td></tr>
<tr class="par"><td><a href="/events/sensibles/2015/09/21-1827-49L.S201509.html" target="centro">2015/09/21 15:27:46</a></td><td>40 km al NO de Valparaíso</td><td>3.2 Ml</td></tr>';
	
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

	echo json_encode(array(
	    "json" => $data,
	    "html" => $table,
	));
	
?>