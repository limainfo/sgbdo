<?php
class Quadro extends AppModel {

	var $name = 'Quadro';
	var $displayField='sigla_quadro';
	var $order = 'Quadro.sigla_quadro asc';
	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
			'Especialidade' => array('className' => 'Especialidade',
								'foreignKey' => 'quadro_id',
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