<?php
require_once '../base/Base.class.php';
$base= new Base();
$connexion=$base->connexion();
require_once '../base/requetes_select.php';

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
		?>

		</div>
		<div class="centre">
			
			<table id="tableRes">
			<colgroup>
				<col width="20%">
				<col width="20%">
				<col width="20%">
				<col width="20%">
				
			</colgroup>
			<thead>
				<tr>
				<td>Num&eacute;ro</td>
				<td>Programme</td>
				<td>Photo</td>
				<td>Nom</td>
				</tr>
			</thead>
			<tbody>
			<?php 
			echo 'Votre choix :';//.$_POST["choix"];
			$choix =$_POST["choix"];
			if ($choix==0){
				echo '<tr><tr>
				<td>0</td>
				<td></td>
				<td></td>
				<td>Vote Blanc</td>
				<input type="radio" name="choix" value="0"></td>
			';
			}else{
				require_once '../services/CandidatService.class.php';
				$serviceCandidat = new CandidatService();
				$serviceCandidat->CandidatChoisi($choix);
			}
			?>
			</tr>
			</tbody>
			</table>
			
			<table id="tableButton" >
				<colgroup>
					<col width="40%">
					<col width="20%">
					<col width="40%">
				</colgroup>
			<tboby>
				<tr>
					<td>
					<form method="post" action ="remercier.php<?php echo $url;?>">
					<input type="hidden" name="choix" value="<?php echo $choix; ?>">
					<input type="submit" class="bouton" value="Confirmer">	
					</form>	
					</td>
					<td>	
					<form method="post" action ="selection.php<?php echo $url;?>">
					<input type="submit"  class="bouton" value="Annuler">
					</form>
					</td>
			</tboby>
			</table>
			
			
		</div>
		
				
	
</body>
</html>