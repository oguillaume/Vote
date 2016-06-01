<?php
require_once '../base/Base.class.php';
$base= new Base();
$connexion=$base->connexion();
require_once '../base/requetes_select.php';
require_once '../base/requetes_vote.php';

if (! isset ( $_GET ['session'] )) {
	header ( 'location: selection.php' );
	exit ();
} else {
	$session = $_GET ['session'];
	$date = $_GET ['date'];
	$identifiant = $_GET ['identifiant'];
	$message = "Session : $session - $identifiant - $date";
}
$url = "?session=$session&date=" . rawurlencode ( $date ) . "&identifiant=" . rawurlencode ( $identifiant );
$actuel = 'Nous sommes le ' . date ( 'd/m/Y' ) . ' ; il est ' . date ( 'H:i:s' );

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
			Mairie de MaVille<br/>
		<?php 
			$id = 1;
			require_once '../services/ElectionService.class.php';
			$serviceElection = new ElectionService();
			$serviceElection->AfficherElection($id);
		?>
		</div>
		<div>
		<div class="gauche">
		Electeur : </br>
		<?php 
		$identifiant = $_GET ['identifiant'];
		require_once '../services/ElecteurService.class.php';
		$serviceElecteur = new ElecteurService();
		$serviceElecteur->AfficherElecteur($identifiant);
		
		$choix = $_POST["choix"];
		require_once '../services/VoteService.class.php';
		$serviceVote= new VoteService();
		$serviceVote->MiseAJourVotes($choix);
		$id=1;
		$serviceVote->miseAJourSignatures($identifiant, $id);
		?>

		</div>
		<div class="centre">
		
		
			La Mairie de MaVille vous remercie pour votre participation &agrave; cette &eacute;lection.</br>
			Nous vous rappellons que le vote est unique et donc que vous ne pouvez plus voter pour cette &eacute;lection.</br>
			En esp&eacute;rant votre participation aux prochains scrutins locaux dans le but d'animer notre ville,</br>
			toute l'&eacute;quipe municipale et moi-meme vous souhaitons une agr&eacute;able journ&eacute;e,</br></br>
			
							Le Maire</br>
		
		<form method="post" action ="../authentification.php">
		<input class="bouton" type="submit" value="Se d&eacute;connecter">
	
		</form>		
		</div>
		</div>
				
	
</body>
</html>
