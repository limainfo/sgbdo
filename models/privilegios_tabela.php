<?php
class PrivilegiosTabela extends AppModel {

	var $name = 'PrivilegiosTabela';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Privilegio' => array('className' => 'Privilegio',
								'foreignKey' => 'privilegio_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Tabela' => array('className' => 'Tabela',
								'foreignKey' => 'tabela_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>