<?php
class PersonneService{
	public function __construct() {
	}
	public function choisirPersonne($id,$conn){
		require('../base/requetes_select.php');
			$requete_personne=$conn->prepare($requete_personne_id);
			$tab_pers=array();
			if($requete_personne==null){
				throw new PDOException("Erreur de préparation de la requête");
			}
			$res=$requete_personne->bindValue(':id',$id,PDO::PARAM_INT);
			if($res==null)
				throw new PDOException("Erreur de requete preparee");
			if($requete_personne->execute()==false)
				$requete_personne->errorInfo();
			while($ligne=$requete_personne->fetch(PDO::FETCH_OBJ)){
				$tab_pers[1]=$ligne->nom;
				$tab_pers[2]=$ligne->prenom;
				$tab_pers[3]=$ligne->adresse;
				$tab_pers[0]=$id;
			}
			return $tab_pers;
	}
}