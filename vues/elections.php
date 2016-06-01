<?php
require_once '../base/Base.class.php';
$base= new Base();
$connexion=$base->connexion();
require_once '../base/requetes_select.php';

if (! isset ( $_GET ['session'] )) {
	header ( 'location: authentification.php' );
	exit ();
} else {
	$session = $_GET ['session'];
	$date = $_GET ['date'];
	$identifiant = $_GET ['identifiant'];
	$message = "Session : $session - $identifiant - $date";
}
$url = "?session=$session&date=" . rawurlencode ( $date ) . "&identifiant=" . rawurlencode ( $identifiant );
$actuel = 'Nous sommes le ' . date ( 'd/m/Y' ) . ' ; il est ' . date ( 'H:i:s' );

if (isset ( $_POST ['connexion'] )) {
	$identifiant = $_GET ['identifiant'];
	$election = $_POST ['election'];
	require_once '../services/VoteService.class.php';
	$serviceVote = new VoteService();
	if ($serviceVote->checkSignatures($identifiant, $election)) {
		header ( "location:remercier.php$url" );
		exit();
	} else{
		header("location:selection.php$url");
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta charset="UTF-8">
	<title>Bureau de vote</title>
	<link style="text/css" href="../css/style.css" rel="stylesheet">
	<link style="text/css" href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<div class="Haut">
			Mairie de Maville<br/>
			
			
	</div>
	
	<div class="gauche">
		Electeur :</br>
	<?php 
		$identifiant = $_GET ['identifiant'];
		require_once '../services/ElecteurService.class.php';
		$serviceElecteur = new ElecteurService();
		$serviceElecteur->AfficherElecteur($identifiant);
	?>
		
	</div>
	<div class="centre">
	<form method="post" action ="selection.php<?php echo $url;?>">
	
		<table id="tableRes">
			<colgroup>
				<col width="20%">
				<col width="20%">
				<col width="20%">
				<col width="20%">
				<col width="20%">
			</colgroup>
			<thead>
				<tr>
				<td>Num&eacute;ro</td>
				<td>Intitul&eacute;</td>
				<td>Type</td>
				<td>Date</td>
				<td>Choix</td>
			</thead>
			<tbody>
			
			<?php
			
			require_once '../services/ElectionService.class.php';
			$serviceElection = new ElectionService();
			$serviceElection->AfficherLesElections();
			
			?>
			</tr>
			</tbody>
		</table>	
		<input type="submit" class="bouton" value="Valider">
	

	</form>
	</div>
	
</body>
</html>
