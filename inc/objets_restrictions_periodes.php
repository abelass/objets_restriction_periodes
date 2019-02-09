<?php
/**
 * Donctions du plugin Objets restrictions périodes.
 *
 * @plugin     Objets restrictions périodes
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Objets_restrictions_periodes\Verifier
 */
 

/**
 * Teste si la date est conforme aux restrictions imposés par la période.
 *
 * @param string $champ
 *   Le champ date à tester.
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   valeurs_restriction -> les valeurs de la restriction
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function periodes_verifier_date($champ, $valeur, $options) {
	// Si une période a été définie inc charge ses données
	$valeurs_restriction = $options['valeurs_restriction'];
	$id_periode = isset($valeurs_restriction['periode']) ?
		$valeurs_restriction['periode'] :
		'';
	$contexte = calculer_contexte();
	$erreur_periode = '';
	$ok = FALSE;
	if ($id_periode) {
		$verifier_periode = charger_fonction('periode_verifier', 'inc');
		// Si la période ne correspond pas, on s'arrête là.
		if (!verifier_periode($id_periode, $contexte)) {
			return $ok;
		}
		else {
			$periode = sql_fetsel('*', 'spip_periodes', "id_periode=$id_periode");
			$titre_periode = $periode['titre'];
			$erreur_periode = "$titre_periode \n";
		}
	}

	$type = $valeurs_restriction['type'];

	switch ($type) {
		case 'duree':
			$intervalle = dates_intervalle($contexte['date_debut'], $contexte['date_fin'], 0, -1);
			$duree = $valeurs_restriction['duree'];
			if ($intervalle < $duree) {
				$erreur = $erreur_periode . _T('objets_restrictions_periodes:erreur_duree', ['duree' => $duree]);

				return $erreur;
			}
			break;

		case 'jours':
			$intervalle = dates_intervalle($contexte['date_debut'], $contexte['date_fin'], 0, -1);

			$jour_restriction = $valeurs_restriction[$champ];
			$jour_contexte = date('N', strtotime($contexte[$champ]));

			if (!empty($jour_restriction) AND ($jour_restriction] != $jour_contexte) {
				$jour = _T('spip:date_jour_' . $jour_restriction);
				$erreur = $erreur_periode . _T(
					'objets_restrictions_periodes:erreur_jours',
					[
						'jour' => $jour,
						'date' => _T('info_' . $champ),
					]);

				return $erreur;
			}
			break;
			
	}

	return $ok;
}