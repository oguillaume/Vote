<?php
/**
 * 
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 */

class Resultat {
	private  $idResultat;
	private  $nbVoix;

	public final  function __construct($idResultat, $nbVoix) {
		$this->idResultat=$idResultat;
		$this->nbVoix=$nbVoix;
	}


	// setters / getters


	public function set_idResultat($value) {
		$this->idResultat = $value;
	}

	public function get_idResultat() {
		return $this->idResultat;
	}


	public function set_nbVoix($value) {
		$this->nbVoix = $value;
	}

	public function get_nbVoix() {
		return $this->nbVoix;
	}


}
?>