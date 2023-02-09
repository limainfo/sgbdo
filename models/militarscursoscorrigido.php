<?php
class Militarscursoscorrigido extends AppModel {

	var $name = 'Militarscursoscorrigido';
	var $validate = array(
		'acao' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Unidade' => array(
			'className' => 'Unidade',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Setor' => array(
			'className' => 'Setor',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Militar' => array(
			'className' => 'Militar',
			'foreignKey' => 'militar_id',
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