<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Réception de données de formulaires</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="reception.css">
</head>

<body>
	<div class="container">
		<!-- METHODE POST -->
		<div class="form-data">
			<h2>Variables reçues par la méthode POST :</h2>
			<?php
			foreach ($_POST as $key => $value) {
				echo "<div>$key : $value</div>";
			}
			?>
		</div>
	</div>
</body>

</html>
