<?php
class Cargosconselho extends AppModel {
	var $name = 'Cargosconselho';
	var $displayField = 'nm_cargo';
	var $validate = array(
		'nm_cargo' => array(
			'alphanumeric' => array(
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