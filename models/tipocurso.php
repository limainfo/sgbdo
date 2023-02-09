<?php
class Tipocurso extends AppModel {

	var $name = 'Tipocurso';
	var $displayField = 'tipo_curso';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Cursoativo' => array(
			'className' => 'Cursoativo',
			'foreignKey' => 'tipocurso_id',
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