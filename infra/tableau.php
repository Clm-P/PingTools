<?php
	$data= file_get_contents("http://185.13.38.55/monitoring_fai.php");
	$data= json_decode($data,true);
	$d[]=$data['ko'];
	/*echo "<pre>";
	print_r($d);
	echo "</pre>";*/
	$i=sizeof($d[0]);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />

	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url:"data.php",
				dataType:"JSON",
				success : function(rep){
					var i;
					for(i=0;i<rep.length;i++){
						var next = $("<tr>").html("<td>"+rep[i].ip+"</td><td>"+rep[i].client+"</td><td>"+rep[i].ping+"</td><td>"+rep[i].loop_error+"</td><td>"+rep[i].zone+"</td>");
						$("table").append(next);
					}
				}
			});
		});
	</script>
</head>
<body>

		<div class="col-lg-12" >
			<div class="tile">
				<div>
					<table class="table table-striped tbl">
						<caption id="cap"></caption>
						<tr>
							<th>ip</th>
							<th>client</th>
							<th>ping</th>
							<th>loop error</th>
							<th>zone</th>
						</tr>

					</table>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>