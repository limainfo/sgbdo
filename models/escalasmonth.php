<?php
class Escalasmonth extends AppModel {

	var $name = 'Escalasmonth';


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