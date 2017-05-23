<?php
// echo "<pre>";
	$_POST['date'] = date("m.d.y");
	$jsondecode = $_POST;
	// var_dump(json_decode($jsondecode));	
	$json_url = "links.json";
	$json = file_get_contents($json_url);
	$data = json_decode($json, TRUE);
	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";	
	// echo "<pre>";
	// print_r($jsondecode['links']);
	// echo "</pre>";
	$countid = count($data);
	if($countid < 0){
		$countid = 0;	
	}
	$countid = count($data);
	$massiveperebor = $jsondecode['links'];
	$linksperebor = explode("\n", $massiveperebor);
	// print_r($linksperebor);
	foreach($linksperebor as $link){
		$vasynya[$countid] = $jsondecode;
		$vasynya[$countid]['links'] = $link;
		$vasynya[$countid]['stat'] = 'Непроверен';
		$vasynya[$countid]['id'] = $countid;
		$countid++;
	}
	$result = array_merge ($data, $vasynya);
	$upload = json_encode($result);
	file_put_contents($json_url, $upload);
	
	
	
	
	echo "<table class='table'><tr><td>Новое зеркало</td><td>Старое зеркало</td><td>Ссылка</td><td>Дата</td><td>Статус</td><td>id</td></tr>";
			
			
				$json_url = "links.json";
				 $json = file_get_contents($json_url);
				 $llinks = json_decode($json, TRUE);
				 $table = '';
				 foreach($llinks as $val){				 
				 $table .= "<tr>";
				 foreach($val as $values){

				  
				  if(is_array($values)) {
				   foreach($values as $key){
				   $table .= "<td>" . $key['value'] ."</td>"; 
				   $table .= "<td>" . $key['stat'] ."</td>"; 
				   }
				  }
				  else {
				   $table .= "<td>" . $values ."</td>";
				  }    




				 }
				  $table .= "</tr>";
				 }
				  echo $table;
			
			
		echo "</table>";
	// print '<pre>';
	// var_dump($upload);
	// print '</pre>';
// echo "</pre>";
?>