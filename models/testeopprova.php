<?php
class Testeopprova extends AppModel {
	var $displayField = 'nm_prova';


	var $name = 'Testeopprova';
	//var $validate = array('posto_id' => array('numeric'),'identidade' => array('alphanumeric'));


		var $hasMany = array(
			'Testeopprovasagendada' => array('className' => 'Testeopprovasagendada',
								'foreignKey' => 'testeopprova_id',
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