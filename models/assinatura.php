<?php
class Assinatura extends AppModel {

	var $name = 'Assinatura';


//	var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>