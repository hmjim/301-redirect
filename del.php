<?php
ini_set('max_execution_time', 0);
ini_set('display_errors',0);

	$json_url = "links.json";
	$json = file_get_contents($json_url);
	$llinks = json_decode($json, TRUE);

	foreach($_POST['inputs'] as  $key => $link){
		$del = ($_POST['inputs'][$key]);
			
		unset($llinks[$del]);

	}
		var_dump($llinks);
	$upload = json_encode($llinks);
	file_put_contents($json_url, $upload);
?>