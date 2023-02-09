<?php
class MilitarsCurso extends AppModel {

	var $name = 'MilitarsCurso';


	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Curso' => array('className' => 'Curso',
								'foreignKey' => 'curso_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>