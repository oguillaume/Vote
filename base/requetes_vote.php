<?php
$requete_vote_update="update resultat set nbvoix=nbvoix+1 where idresultat in
(select idresultat from a_un where idpersonne in
(select idpersonne from candidat where id_candidat=:id))";

$requete_vote_select="select nbvoix from resultat where idresultat in 
(select idresultat from a_un where idpersonne in
(select idpersonne from candidat where id_candidat=:id))";

$requete_sign_update="update votepour set signatures=true where id_election=:election and idpersonne in
(select idpersonne from electeur where identifiant=:ident)";

$requete_sign_select="select signatures from votepour where id_election=:election and idpersonne in
		(select idpersonne from electeur where identifiant=:ident)";

?>