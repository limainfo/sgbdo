<?php
class Ocorrenciastecnica extends AppModel {

	var $name = 'Ocorrenciastecnica';

	//var $actsAs = array('Logable'); 
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Equipamento' => array(
			'className' => 'Equipamento',
			'foreignKey' => 'equipamento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>