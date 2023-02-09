<?php
class Privilegio extends AppModel {
	var $displayField = 'descricao';
	
	var $name = 'Privilegio';


//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Tabela' => array('className' => 'Tabela',
						'joinTable' => 'privilegios_tabelas',
						'foreignKey' => 'privilegio_id',
						'associationForeignKey' => 'tabela_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'Usuario' => array('className' => 'Usuario',
						'joinTable' => 'privilegios_usuarios',
						'foreignKey' => 'privilegio_id',
						'associationForeignKey' => 'usuario_id',
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