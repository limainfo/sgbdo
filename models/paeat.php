<?php
class Paeat extends AppModel {

	var $name = 'Paeat';
	
		var $hasMany = array(
			'Paeatsindicado' => array('className' => 'Paeatsindicado',
								'foreignKey' => 'paeat_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ' responsavel asc, privilegio asc, referenciavaga asc, prioridade asc, atributo asc',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Paeatsdistribuicao' => array('className' => 'Paeatsdistribuicao',
								'foreignKey' => 'paeat_id',
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
}
?>