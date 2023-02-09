<?php
class MilitarsEscala extends AppModel {

	var $name = 'MilitarsEscala';
	var $validate = array(
		'codigo' => array('alphanumeric')
	);

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Escala' => array('className' => 'Escala',
								'foreignKey' => 'escala_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);



}
?>