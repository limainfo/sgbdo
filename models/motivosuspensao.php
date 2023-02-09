<?php
class Motivosuspensao extends AppModel {
	var $name = 'Motivosuspensao';
	var $displayField = 'nm_motivo';
	var $validate = array(
		'nm_motivo' => array(
			'string' => array(
				'rule' => array('string'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descricao' => array(
			'string' => array(
				'rule' => array('string'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>