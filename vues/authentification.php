<?php

function identifiant_unique() {
	return md5 ( uniqid ( rand () ) );
}

$identifiant = ' ';
$mot_de_passe = ' ';
$message = ' ';
if (isset ( $_POST ['connexion'] )) {
	$identifiant = $_POST ['identifiant'];
	$mot_de_passe = $_POST ['mot_de_passe'];
	require_once '../services/ElecteurService.class.php';
	$serviceElecteur = new ElecteurService();
	if ($serviceElecteur->UtilisateurExiste( $identifiant, $mot_de_passe )) {
		$session = identifiant_unique ();
		$date = date ( '\l\e d/m/Y à H:i:s' );
		$url = "?session=$session&date=" . rawurlencode ( $date ) . "&identifiant=" . rawurlencode ( $identifiant );
		
			header ( "location:elections.php$url" );
		
		exit ();
	} else {
		$message = 'Identification incorrecte. Essayez de nouveau.';
	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

	<title>Bureau de vote</title>
	<link style="text/css" href="../css/style.css" rel="stylesheet">
	<link style="text/css" href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<div class="Haut">
			Mairie de MaVille<br/>
		
	</div>
	<div class="centre">
	Bienvenue sur le site des &eacute;lections de la ville de MaVille,</br>
	veuillez vous identifier.
	
		<div class="general" align="center">
		<form action="authentification.php" method="post">
		<table border="0px">
			<tr>
				<td align="right">Identifiant :</td>
				<td><input type="text" Name="identifiant"
					value="" /></td>
			</tr>
			<tr>
				<td align="right">Mot de passe :</td>
				<td><input type="password" Name="mot_de_passe"
					value="" /></td>
			</tr>
			<tr>
				<td></td>
				<td align="right"><input type="submit" name="connexion"
					value="Connexion" /></td>
			</tr>
		</table>
		</form>
		</div>
		<div><?php echo $message; ?>
		</div>
	</div>


</body>
</html>