<?php
class ElectionService{
	public function __construct(){}
	
	public function AfficherElection($id){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_select.php');
		$requete_elec=$connexion->prepare($requete_election);
		if($requete_elec==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}		
		$requete=$requete_elec->bindValue(':idelection',$id,PDO::PARAM_INT);
		if($requete==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_elec->execute()==false){
			$requete_elec->errorInfo();
		}
		$ligne=$requete_elec->fetchAll();
		$nb_colonnes=$requete_elec->columnCount();
		$nb_lignes=$requete_elec->rowCount();
		//	echo $nb_colonnes.' '.$nb_lignes.'</br>';
		for($i=0;$i<$nb_lignes;$i++){
			for($j=1;$j<$nb_colonnes;$j++){
				if ($j==1) echo 'Election de :'.$ligne[$i][$j].'</br>';
				else if($j==3) echo 'Le '.$ligne[$i][$j];
					
			}
		}
	}
	public function AfficherLesElections(){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_select.php');
		$forme_resultats_all_elections=$connexion->query($requete_all_elections);
		$elections=$forme_resultats_all_elections->fetchAll();
		$nb_lignes=$forme_resultats_all_elections->rowCount();
		$nb_colonnes=$forme_resultats_all_elections->columnCount();
		for($i=0;$i<$nb_lignes;$i++){
			echo "\n".'<tr>';
			//	echo '<td>'.($i+1).'</td>';
			for($j=0;$j<$nb_colonnes;$j++){
				if ($j==0) echo '<td>'.($i+1).'</td>';
				else {
						echo '<td>'.$elections[$i][$j].'</td>';
					
				}
			}
			echo "\n".'<td><input type="radio" name="election" value="'.($i+1).'"></td>'."\n";
			echo "\n".'</tr>';
		
		}
	}
}