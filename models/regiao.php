<?php
class Regiao extends AppModel {

	var $name = 'Regiao';
	var $displayField='descricao';
	//var $order = 'Regiao.descricao asc';
//	var $order = 'sigla_setor';
	
	var $validate = array(
		'nome' => array('alphanumeric')
	);


	var $hasMany = array(
			'Console' => array('className' => 'Console',
								'foreignKey' => 'regiao_id',
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