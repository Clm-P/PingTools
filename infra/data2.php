<?php
$data= file_get_contents("http://185.13.38.55/monitoring_fai.php");
$data= json_decode($data,true); 
foreach ($data as $d) {
	foreach ($d as $t) {
		$tab[] = $t;
	}
}
rsort($tab);
echo json_encode($tab);
?>