<?php
/**
 * 
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 * @see        Personne
 */
require_once('Personne.class.php');

class Candidat extends Personne {
	private  $idCandidat;
	private  $programme;
	private  $photo;

	public final function __construct($idPersonne,$nom,$prenom,$adresse,
			$idCandidat,$programme,$photo) {
		parent::__construct($idPersonne,$nom,$prenom,$adresse);
		$this->idCandidat=$idCandidat;
		$this->photo=$photo;
		$this->programme=$programme;
	}
	// setters / getters
	public function set_idCandidat($value) {
		$this->idCandidat = $value;
	}
	public function get_idCandidat() {
		return $this->idCandidat;
	}
	public function set_programme($value) {
		$this->programme = $value;
	}
	public function get_programme() {
		return $this->programme;
	}
	public function set_photo($value) {
		$this->photo = $value;
	}

	public function get_photo() {
		return $this->photo;
	}
	
}
?>