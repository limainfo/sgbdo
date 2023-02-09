<?php
class BaseIndicLoc extends AppModel {
	var $name = 'BaseIndicLoc';
	var $displayField = 'indicativo';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'EptaEpta' => array(
			'className' => 'EptaEpta',
			'foreignKey' => 'base_indic_loc_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>