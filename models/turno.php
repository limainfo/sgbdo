<?php
class Turno extends AppModel {

	var $name = 'Turno';
	var $validate = array(
		'qtd' => array('numeric')
	);

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Escala' => array('className' => 'Escala',
								'foreignKey' => 'escala_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>