<?php
class Periodicidade extends AppModel {

	var $name = 'Periodicidade';
	var $displayField = 'desc_periodicidade';

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Rotina' => array('className' => 'Rotina',
								'foreignKey' => 'periodicidade_id',
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