<?php
class VoteService{
	public function __construct(){}
	
	public function MiseAJourVotes($choix){
		require_once '../base/Base.class.php';
		$base= new Base();
		$connexion=$base->connexion();
		require('../base/requetes_vote.php');
		$requete_vote_up=$connexion->prepare($requete_vote_update);
		if($requete_vote_up==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		$requete2=$requete_vote_up->bindValue(':id', $choix,PDO::PARAM_INT);
		if($requete2==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_vote_up->execute()==false){
			$requete_vote_up->errorInfo();
		}
	}
	public function checkSignatures($identifiant,$election) {
		require_once '../base/Base.class.php';
		$base=new Base();
		$connexion=$base->connexion();
		require '../base/requetes_vote.php';
		$requete_sign_sel=$connexion->prepare($requete_sign_select);
		if($requete_sign_sel==null){
			throw  new Exception('Erreur lors de la préparation de larequete ');
		}
		$requete3=$requete_sign_sel->bindValue(':ident',$identifiant,PDO::PARAM_STR);
		$requete3=$requete_sign_sel->bindValue(':election',$election,PDO::PARAM_INT);
		if($requete3==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_sign_sel->execute()==false){
			$requete_sign_sel->errorInfo();
		}
	}
	public function miseAJourSignatures($identifiant,$election){
		require_once '../base/Base.class.php';
		$base=new Base();
		$connexion=$base->connexion();
		require '../base/requetes_vote.php';
		$requete_sign_up=$connexion->prepare($requete_sign_update);
		if($requete_sign_up==null){
			throw  new Exception('Erreur lors de la préparation de larequete ');
		}
		$requete4=$requete_sign_up->bindValue(':election',1,PDO::PARAM_INT);
		$requete4=$requete_sign_up->bindValue(':ident',$identifiant,PDO::PARAM_STR);		
		if($requete4==null){
			throw new Exception('Erreur lors de la préparation de la requete ');
		}
		if($requete_sign_up->execute()==false){
			$requete_sign_up->errorInfo();
		}
	}
}