<?php
class Membrosconselho extends AppModel {
	var $name = 'Membrosconselho';
	var $displayField = 'militar_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Militar' => array(
			'className' => 'Militar',
			'foreignKey' => 'militar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unidade' => array(
			'className' => 'Unidade',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cargosconselho' => array(
			'className' => 'Cargosconselho',
			'foreignKey' => 'cargosconselho_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>