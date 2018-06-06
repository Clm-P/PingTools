<?php
	session_start();
	if ($_SESSION['user']==NULL) {
			header("location: connexion.php");
			exit;
	}
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
				url:"data2.php",
				dataType:"JSON",
				success : function(rep){
					var i;
					for(i=0;i<rep.length;i++){
						var next = $("<tr>").html("<td>"+rep[i].id+"</td><td>"+rep[i].ip+"</td><td>"+rep[i].client+"</td><td>"+rep[i].loop_error+"</td><td>"+rep[i].ping+"</td><td>"+rep[i].sms+"</td><td>"+rep[i].info+"</td><td>"+rep[i].zone+"</td><td><a href='manage.php?id="+rep[i].id+"' class='btn btn-danger'>Supprimer</a></td>");
						$("table").append(next);
					}
				}
			});
		});

		function searchString() {
		    var Sstring = $('#string').val();
		    if (Sstring!='') {
		    	$("tr:contains('" + Sstring + "')").css("background", "lightgrey");
		    	var n = $("td:contains('" + Sstring + "')").length;
		    	$("tr:contains('" + Sstring + "')")[0].scrollIntoView(true);
		    }
		}
		
		function clearSearch() {
    		var Sstring = $('#string').val();
   			 if (Sstring != '') {
        		$("tr:contains('" + Sstring + "')").css("background", "none");
    		}
		}

	</script>


	<style type="text/css">
		.coucou{
			width: 350px;
			margin: auto;
		}
	</style>
</head>
<body>

		<a href='formulaire.php' class='btn btn-success' style="float: left; margin: 8px; position: absolute;">+ Ajouter une fai</a>
		<a href='deconnexion.php' class='btn btn-warning' style="float: right; margin: 8px;">D&eacute;connexion</a>
		<div class="col-lg-6 col-lg-push-3">
			<div class="tile">
				<div>
						<input id="string" name="string" type="text" class="form-control coucou" onfocus="clearSearch()" />
						<input type="submit" value="Rechercher" class="btn btn-primary" onclick="searchString()"/>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="tile">
				<div>
					<table class="table table-striped tbl">
						<caption id="cap"></caption>
						<tr>
							<th>id</th>
							<th>ip</th>
							<th>client</th>
							<th>loop error</th>
							<th>ping</th>
							<th>sms</th>
							<th>info</th>
							<th>zone</th>
							<th>Supprimer</th>
						</tr>

					</table>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>