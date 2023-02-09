<?php
class Bcasassinado extends AppModel {

	var $name = 'Bcasassinado';


	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Bca' => array('className' => 'Bca',
								'foreignKey' => 'bca_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>