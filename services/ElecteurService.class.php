<?php
require_once ('../services/PersonneService.class.php');
require_once ('../base/Electeur.class.php');
class ElecteurService{
	
	public function  __construct(){
	}
	public function ChoixElecteur($identifiant){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_select.php');
		$requete_electeur_ide=$connexion->prepare($requete_electeur_id);
		if($requete_electeur_ide==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		$requete=$requete_electeur_ide->bindValue(':id',$identifiant,PDO::PARAM_STR);
		if($requete==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_electeur_ide->execute()==false){
			$requete_electeur_ide->errorInfo();
		}
		$electeur=$requete_electeur_ide->fetchAll();
		$nb_colonnes=$requete_electeur_ide->columnCount();
		$idElecteur=$electeur[0][0];
		$motDePasse=$electeur[0][2];
		$dateDeNaissance=$electeur[0][3];
		$idPersonne=$electeur[0][4];
		$servicePersonne= new PersonneService();
		$tab_pers=array();
		$tab_pers=$servicePersonne->choisirPersonne($idPersonne, $connexion);
		$nom=$tab_pers[1];
		$prenom=$tab_pers[2];
		$adresse=$tab_pers[3];
		$electeur=new Electeur($idPersonne, $nom, $prenom, $adresse, 
				$idElecteur, $identifiant, $motDePasse, $dateDeNaissance);
		return $electeur;
		
	}
	public function AfficherElecteur($identifiant){
		$serviceElecteur= new ElecteurService();
		$electeur=$serviceElecteur->ChoixElecteur($identifiant);
		echo $electeur->get_nom().'</br>';
		echo $electeur->get_prenom().'</br>';
		echo $electeur->get_adresse().'</br>';	
	}
	function UtilisateurExiste($identifiant, $mot_de_passe) { //à revoir en PDO
		require_once 'base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		//	$options=[ 'cost'=>8,];
		//	echo password_hash($mot_de_passe, PASSWORD_BCRYPT,$options);
		$pass_hache=sha1($mot_de_passe);
		$requete_electeur_idAndPasse = "SELECT COUNT(*) FROM Electeur ";
		$requete_electeur_idAndPasse .= "WHERE identifiant ='".$identifiant."' AND mot_de_passe ='".$pass_hache."'";
		$requete_electeur=$connexion->query($requete_electeur_idAndPasse)->fetch();
		return ($requete_electeur['count']==1);
	}
}
?>