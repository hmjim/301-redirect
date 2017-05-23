<?php
		$header = get_headers($_POST[link]);
		if($header[0] == 'HTTP/1.1 301 Moved Permanently'){
			$json_url = "error.json";
			$json = file_get_contents($json_url);
			$llinks = json_decode($json, TRUE);
			$idd = $_POST['id'];
			unset($llinks[$idd]);
			$errorpath = "error.json";
			$errorurl = json_encode($llinks);
			file_put_contents($errorpath, $errorurl);
				echo 'true';
			} else {
				echo 'false';
			}

?>