<?php
class Tabela extends AppModel {
	var $displayField = 'tabela';
	
	var $name = 'Tabela';
	var $validate = array(
		'tabela' => array('alphanumeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Privilegio' => array('className' => 'Privilegio',
						'joinTable' => 'privilegios_tabelas',
						'foreignKey' => 'tabela_id',
						'associationForeignKey' => 'privilegio_id',
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