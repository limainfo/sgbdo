<?php
class Instituicaoensino extends AppModel {
	var $name = 'Instituicaoensino';
	var $displayField = 'nm_instituicao';
	var $validate = array(
		'nm_instituicao' => array(
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