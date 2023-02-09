<?php
class Paeatsdistribuicao extends AppModel {

	var $name = 'Paeatsdistribuicao';
	var $belongsTo = array(
			'Paeat' => array('className' => 'Paeat',
								'foreignKey' => 'paeat_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								));
}
?>