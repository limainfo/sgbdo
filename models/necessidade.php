<?php
class Necessidade extends AppModel {
	var $name = 'Necessidade'; 
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
		),
		'Unidade' => array('className' => 'Unidade',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quadro' => array('className' => 'Quadro',
			'foreignKey' => 'quadro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>