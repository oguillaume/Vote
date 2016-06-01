<?php

$requete_all_candidats="SELECT * FROM Candidat";

$requete_personne_id="SELECT * FROM Personne WHERE idpersonne=:id";

$requete_electeur_id="SELECT * FROM Electeur WHERE identifiant=:id";

$requete_candidat_id="SELECT * FROM Candidat WHERE id_candidat=:id";

$requete_election="SELECT * FROM Election WHERE id_election=:idelection";

$requete_all_elections="SELECT * FROM Election";

?>
<?php
/*$requete_all_electeurs="SELECT * FROM Electeur";
$forme_resultats_all_electeurs=$connexion->query($requete_all_electeurs);
$forme_resultats_all_electeurs->setFetchMode(PDO::FETCH_OBJ);
*/
?>
