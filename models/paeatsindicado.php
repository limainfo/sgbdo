<?php
class Paeatsindicado extends AppModel {

	var $name = 'Paeatsindicado';
	var $order = 'responsavel asc, privilegio asc, referenciavaga asc, prioridade asc, atributo asc ';
	var $belongsTo = array(
			'Paeat' => array('className' => 'Paeat',
								'foreignKey' => 'paeat_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
	);
								
}
?>