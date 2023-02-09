<?php
class EptaEpta extends AppModel {
	var $name = 'EptaEpta';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'BaseIndicLoc' => array(
			'className' => 'BaseIndicLoc',
			'foreignKey' => 'base_indic_loc_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>