<?php
/**
 * Classe Base
 * Attributs : aucun
 * G�re les acc�s � la BDD et les requ�tes
 */
class Base{
	
	public function __construct(){}
	
	public function connexion(){
		try{
		require ('../Proprietes/proprietes.php');		
		$connexion = new PDO($gestio.':host='.$ip.';port='.$port.';dbname='.$base, $utilisateur, $passe);
		return $connexion;
		}catch (PDOException $e){
			$msg='ErreurPDO:'.$e->getFile().',L'.$e->getLine().':'.$e->getMessage();
			$msg.='\n '.$gestio.':host='.$ip.';dbname='.$base.' '.$utilisateur.' '. $passe;
			die($msg);
		}
		
	}
	public function deconnexion(){
		$connexion->close();
	}
	
	public function executerRequeteUpdate($requete){
		$connexion->exec($requete);
	}
	public function executerRequeteQuery($requete){
		$resultats=$connexion->query($requete);
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$tab_result=array();
	}
	
}
?>