<?php
class Controlehora extends AppModel {

	var $name = 'Controlehora';
	var $validate = array(
	);

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => 'Militar.ativa=1',
								'fields' => '',
								'order' => ''
			)
	);

}
?>