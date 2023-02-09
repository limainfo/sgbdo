<?php
class Curso extends AppModel {

	var $name = 'Curso';
	var $displayField = 'codigo';
	var $order = 'Curso.codigo asc';
	var $validate = array(
	);
//		'codigo' => array('alphanumeric')

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Cursoativo' => array('className' => 'Cursoativo',
								'foreignKey' => 'curso_id',
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

	var $hasAndBelongsToMany = array(
			'Militar' => array('className' => 'Militar',
						'joinTable' => 'militars_cursos',
						'foreignKey' => 'curso_id',
						'associationForeignKey' => 'militar_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>