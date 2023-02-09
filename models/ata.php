<?php
class Ata extends AppModel {
	var $name = 'Ata';
	var $displayField = 'numero';
	var $validate = array(
		'data_reuniao' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Unidade' => array(
			'className' => 'Unidade',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Boletiminterno' => array(
			'className' => 'Boletiminterno',
			'foreignKey' => 'boletiminterno_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>