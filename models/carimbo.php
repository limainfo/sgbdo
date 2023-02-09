<?php
class Carimbo extends AppModel {
	var $name = 'Carimbo';
	var $displayField = 'emitente';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Licenca' => array(
			'className' => 'Licenca',
			'foreignKey' => 'carimbo_id',
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
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Militar.nm_completo asc'
			)
	);	

}
?>