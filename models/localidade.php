<?php
class Localidade extends AppModel {

	var $name = 'Localidade';
	var $displayField='sigla_localidade';
	var $order = 'Localidade.sigla_localidade asc';
	//var $actsAs = array('Logable'); 
/*	
	var $validate = array(
		'sigla_localidade' => array('string')
	);
*/
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => 'localidade_id',
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