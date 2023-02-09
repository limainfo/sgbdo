<?php
class Bca extends AppModel {

	var $name = 'Bca';
	//var $actsAs = array('Logable'); 
	
	var $hasMany = array(
			'Bcasassinado' => array('className' => 'Bcasassinado',
								'foreignKey' => 'bca_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			));
	
}
?>