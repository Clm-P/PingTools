<?php
$data= file_get_contents("http://185.13.38.55/monitoring_fai.php");
$data= json_decode($data,true); 
$data2[]=$data["ko"];
foreach ($data2 as $d) {
	foreach ($d as $t) {
		if($t['sms']==1){
		$tab[] = array('ping' => $t['ping'],
						'loop_error' =>$t['loop_error'],
						'client' =>$t['client'],
						'zone' =>$t['zone'],
						'ip' =>$t['ip'],
						'id' =>$t['id']);
		}
	}
}
rsort($tab);
echo json_encode($tab);
?>