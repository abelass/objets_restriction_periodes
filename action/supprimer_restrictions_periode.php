<?php
/**
 * Utilisation de l'action supprimer pour l'objet restrictions_periode
 *
 * @plugin     Objets restrictions périodes
 * @copyright  2019
 * @author     Rainer
 * @licence    GNU/GPL v3
 * @package    SPIP\Objets_restrictions_periodes\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Action pour supprimer un·e restrictions_periode
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, restrictions_periode, #ID_RESTRICTIONS_PERIODE}|oui)
 *         [(#BOUTON_ACTION{<:restrictions_periode:supprimer_restrictions_periode:>,
 *             #URL_ACTION_AUTEUR{supprimer_restrictions_periode, #ID_RESTRICTIONS_PERIODE, #URL_ECRIRE{restrictions_periodes}},
 *             danger, <:restrictions_periode:confirmer_supprimer_restrictions_periode:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, restrictions_periode, #ID_RESTRICTIONS_PERIODE}|oui)
 *         [(#BOUTON_ACTION{
 *             [(#CHEMIN_IMAGE{restrictions_periode-del-24.png}|balise_img{<:restrictions_periode:supprimer_restrictions_periode:>}|concat{' ',#VAL{<:restrictions_periode:supprimer_restrictions_periode:>}|wrap{<b>}}|trim)],
 *             #URL_ACTION_AUTEUR{supprimer_restrictions_periode, #ID_RESTRICTIONS_PERIODE, #URL_ECRIRE{restrictions_periodes}},
 *             icone s24 horizontale danger restrictions_periode-del-24, <:restrictions_periode:confirmer_supprimer_restrictions_periode:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     if (autoriser('supprimer', 'restrictions_periode', $id_restrictions_periode)) {
 *          $supprimer_restrictions_periode = charger_fonction('supprimer_restrictions_periode', 'action');
 *          $supprimer_restrictions_periode($id_restrictions_periode);
 *     }
 *     ```
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_restrictions_periode_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_restrictions_periodes',  'id_restrictions_periode=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_restrictions_periode_dist $arg pas compris");
	}
}
