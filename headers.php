<?php
ini_set('max_execution_time', 0);
ini_set('display_errors',0);
//ini_set('error_reporting',2047);
$data = (object)$_POST;
$offset = 0;
$limit = 0;
$offset = $data->offset;
$limit = $data->limit;
$maxmumun = $offset + ($limit - 1);
$rows = 'links.json';
$rows = file_get_contents($rows);
$rows = json_decode($rows);
$result = new stdClass();
$result->objects = array();
$errorlinks = array();

				
foreach ($rows as $key => $row) {

	if ($key >= $offset) {

		$row->headers = get_headers($row->links);
		$object = new stdClass();
		$object->old = $row->old;
		$object->new = $row->new;
		$object->links = $row->links;
		$object->data = date('d.m.y');
		$object->stat = 'Error :'. $row->headers[0];
		if (preg_match('/301/',$row->headers[0])) {
			$object->stat = 'OK';
		} 
		// else
		// {
			// $errorlinks[$key]['old'] = $row->old;
			// $errorlinks[$key]['links'] = $row->links;
			// $errorlinks[$key]['error'] = $row->headers[0];
			// $errorlinks[$key]['id'] = $row->id;
			// $errorlinks[$key]['button'] = '<button id="curlreply" class="btn btn-primary" data-id="'.$row->id.'">Проверка</button>';
		// }
		$object->id = $row->id;

		$result->objects[$row->id] = $object;
		$rows[$object->id] = $object;
	}
	if ($key == $maxmumun) {
		break;
	}
}

$result->count = count($result->objects);
$result->html = '';
foreach ($result->objects as $object) {
	$result->html .= '<tr>';
	$result->html .= '<td>'.$object->old.'</td>';
	$result->html .= '<td>'.$object->new.'</td>';
	$result->html .= '<td>'.$object->links.'</td>';
	$result->html .= '<td>'.$object->data.'</td>';
	$result->html .= '<td>'.$object->stat.'</td>';
	$result->html .= '<td>'.$object->id.'</td>';
	$result->html .= '</tr>';
	
}
$rows = json_encode($rows);
file_put_contents('links.json', $rows);
	// $errorpath = "error.json";
	// $errorlinks = json_encode($errorlinks);
	// file_put_contents($errorpath, $errorlinks, FILE_APPEND);
	
echo json_encode($result);


?>