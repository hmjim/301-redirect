<?php
ini_set('max_execution_time', 0);
ini_set('display_errors',0);
	$json_url = "links.json";
	$json = file_get_contents($json_url);
	$llinks = json_decode($json, TRUE);
	// print '<pre>';
	// var_dump($llinks);
	// print '</pre>';
	
	
	
	for ($i = 0; $i < count($llinks); $i++){
		$headers = get_headers($llinks[$i]['links']);
	//	var_dump($headers[0]); 
		if($headers[0] == 'HTTP/1.1 301 Moved Permanently'){
			$llinks[$i]['stat'] = 'Проверено';
			$llinks[$i]['date'] = date("m.d.y");

		} else{
			$llinks[$i]['stat'] = 'Ошибка';
			$llinks[$i]['date'] = date("m.d.y");
			$errorlinks[$i]['old'] = $llinks[$i]['old'];
			$errorlinks[$i]['links'] = $llinks[$i]['links'];
			$errorlinks[$i]['error'] = $headers[0];
			$errorlinks[$i]['id'] = $llinks[$i]['id'];
			$errorlinks[$i]['button'] = '<button id="curlreply" class="btn btn-primary" data-id="'.$errorlinks[$i]['id'].'">Проверка</button>';
			
		}
	}
			
	$upload = json_encode($llinks);
	file_put_contents($json_url, $upload);
	
	$errorpath = "error.json";
	$errorurl = json_encode($errorlinks);
	file_put_contents($errorpath, $errorurl);
	
	
	
				// echo "<table class='table'><tr><td>Новое зеркало</td><td>Старое зеркало</td><td>Ссылка</td><td>Дата</td><td>Статус</td><td>id</td></tr>";
				// $json_url = "links.json";
				 // $json = file_get_contents($json_url);
				 // $llinks = json_decode($json, TRUE);
				 // $table = '';
				 // foreach($llinks as $val){				 
				 // $table .= "<tr>";
				 // foreach($val as $values){
				  // if(is_array($values)) {
				   // foreach($values as $key){
				   // $table .= "<td>" . $key['value'] ."</td>"; 
				   // $table .= "<td>" . $key['stat'] ."</td>"; 
				   // }
				  // }
				  // else {
				   // $table .= "<td>" . $values ."</td>";
				  // }    
				 // }
				  // $table .= "</tr>";
				 // }
				  // echo $table;
		// echo "</table>";
?>