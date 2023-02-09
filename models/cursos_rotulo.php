<?php
class CursosRotulo extends AppModel {

	var $name = 'CursosRotulo';
	var $actsAs = array('Logable'); 
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Rotulo' => array('className' => 'Rotulo',
								'foreignKey' => 'rotulo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Curso' => array('className' => 'Curso',
								'foreignKey' => 'curso_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Curso.codigo asc'
			)
	);

}
?>