<?php
class Empresa extends AppModel {
	var $name = 'Empresa';
	var $displayField = 'nm_empresa';
	var $validate = array(
		'nm_empresa' => array(
			'alphanumeric' => array(
				'rule' => array('string'),
				'message' => 'Somente a-ZA-Z',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sigla_empresa' => array(
			'alphanumeric' => array(
				'rule' => array('string'),
				'message' => 'Somente a-ZA-Z',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>