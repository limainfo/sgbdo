<?php
class EspecialidadesSetor extends AppModel {

	var $name = 'EspecialidadesSetor';
	//var $actsAs = array('Logable'); 
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Especialidade' => array(
			'className' => 'Especialidade',
			'foreignKey' => 'especialidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Setor' => array(
			'className' => 'Setor',
			'foreignKey' => 'setor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Curso' => array(
			'className' => 'Curso',
			'foreignKey' => 'curso_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>