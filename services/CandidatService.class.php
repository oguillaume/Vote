<?php
require_once ('../services/PersonneService.class.php');
require_once ('../base/Candidat.class.php');

class CandidatService{
	public function __construct(){}
	
	public function ListerCandidats(){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_select.php');
		$forme_resultats_all_candidats=$connexion->query($requete_all_candidats);
		$candidats=$forme_resultats_all_candidats->fetchAll();
		$nb_lignes=$forme_resultats_all_candidats->rowCount();
		$nb_colonnes=$forme_resultats_all_candidats->columnCount();
		$listeCandidats=array();
		$servicePersonne = new PersonneService();
		for($i=0;$i<$nb_lignes;$i++){	
			
			$tab_pers=array();
			$idCandidat=$candidats[$i][0];
			$programme=$candidats[$i][1];
			$idPersonne=$candidats[$i][3];
			$tab_pers=$servicePersonne->choisirPersonne($idPersonne, $connexion);		
			$photo=$candidats[$i][2];
			$nom=$tab_pers[1];
			$prenom=$tab_pers[2];
			$candidat=new Candidat($idPersonne,$nom,$prenom,"",$idCandidat,$programme,$photo);
			$listeCandidats[$i]=$candidat;
		}
		return $listeCandidats;
	}
	
	public function AfficherCandidats(){
		$serviceCandidat = new CandidatService();
		$listeCandidats=$serviceCandidat->ListerCandidats();
		$i=0;
		foreach ($listeCandidats as $cand){
			echo "\n".'<tr>';
			echo '<td>'.($i+1).'</td>';
			echo '<td>'.$cand->get_programme().'</td>';
			echo '<td><img src="'.$cand->get_photo().'"height="50" width="50"></td>';
			echo '<td>'.$cand->get_nom()." ".$cand->get_prenom().'</td>';	
			echo "\n".'<td><input type="radio" 
					name="choix" value="'.$cand->get_idCandidat().'"></td>'."\n";
			echo "\n".'</tr>';
			$i++;
			
		}
	}
	public function CandidatChoisi($choix){
		$serviceCandidat = new CandidatService();
		$candidat=$serviceCandidat->ChoixCandidat($choix);
		echo "\n".'<tr>';
		echo '<td>'.($candidat->get_idCandidat()).'</td>';
		echo '<td>'.$candidat->get_programme().'</td>';
		echo '<td><img src="'.$candidat->get_photo().'"height="50" width="50"></td>';
		echo '<td>'.$candidat->get_nom()." ".$candidat->get_prenom().'</td>';
		echo "\n".'</tr>';
		
	}
	public function ChoixCandidat($choix){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_select.php');
		$requete_candidat_ide=$connexion->prepare($requete_candidat_id);
		if($requete_candidat_ide==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		$requete=$requete_candidat_ide->bindValue(':id',$choix,PDO::PARAM_STR);
		if($requete==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_candidat_ide->execute()==false){
			$requete_candidat_ide->errorInfo();
		}
		$candidats=$requete_candidat_ide->fetchAll();
		$nb_colonnes=$requete_candidat_ide->columnCount();
		$idCandidat=$candidats[0][0];
		$programme=$candidats[0][1];
		$photo=$candidats[0][2];
		$idPersonne=$candidats[0][3];
		$servicePersonne = new PersonneService();
		$tab_pers=array();
		$tab_pers=$servicePersonne->choisirPersonne($idPersonne, $connexion);
		$nom=$tab_pers[1];
		$prenom=$tab_pers[2];
		$candidat=new Candidat($idPersonne,$nom,$prenom,"",$idCandidat,$programme,$photo);
		return $candidat;
		
	}
	
}
?>