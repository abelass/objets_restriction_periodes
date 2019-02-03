<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Objets restrictions périodes
 * @copyright  2019
 * @author     Rainer
 * @licence    GNU/GPL v3
 * @package    SPIP\Objets_restrictions_periodes\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function objets_restrictions_periodes_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['restrictions_periodes'] = 'restrictions_periodes';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function objets_restrictions_periodes_declarer_tables_objets_sql($tables) {

	$tables['spip_restrictions_periodes'] = array(
		'type' => 'restrictions_periode',
		'principale' => 'oui',
		'table_objet_surnoms' => array('restrictionsperiode'), // table_objet('restrictions_periode') => 'restrictions_periodes' 
		'field'=> array(
			'id_restrictions_periode' => 'bigint(21) NOT NULL',
			'titre'              => 'varchar(255) NOT NULL DEFAULT ""',
			'descriptif'         => 'text NOT NULL DEFAULT ""',
			'id_periode'         => 'bigint(21) NOT NULL DEFAULT 0',
			'type'               => 'varchar(20) NOT NULL DEFAULT ""',
			'duree'              => 'int(11) NOT NULL DEFAULT 0',
			'jour_debut'         => 'int(1) NOT NULL DEFAULT 0',
			'jour_fin'           => 'int(1) NOT NULL DEFAULT 0',
			'date'               => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_restrictions_periode',
		),
		'titre' => 'titre AS titre, "" AS lang',
		'date' => 'date',
		'champs_editables'  => array('titre', 'descriptif', 'id_periode', 'type', 'duree', 'jour_debut', 'jour_fin'),
		'champs_versionnes' => array('titre', 'descriptif', 'id_periode', 'type', 'duree', 'jour_debut', 'jour_fin'),
		'rechercher_champs' => array("titre" => 10, "descriptif" => 8),
		'tables_jointures'  => array(),


	);

	return $tables;
}
