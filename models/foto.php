<?php
class Foto extends AppModel {

	var $name = 'Foto';
	var $displayField = 'name';


//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Militar.nm_completo asc'
			)
	);

}
?>