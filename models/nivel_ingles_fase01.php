<?php
class NivelInglesFase01 extends AppModel {
	var $name = 'NivelInglesFase01';
	var $displayField = 'nota';
	var	$order = 'NivelInglesFase01.ano DESC';
	var $validate = array(
	'ano' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Militar' => array(
			'className' => 'Militar',
			'foreignKey' => 'militar_id',
			'conditions' => '',
			'fields' => ''
			)
		);
		
	
}
?>