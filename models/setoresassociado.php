<?php
class Setoresassociado extends AppModel {

	var $name = 'Setoresassociado';

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Setor' => array(
			'className' => 'Setor',
			'foreignKey' => 'setor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



}
?>