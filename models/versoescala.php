<?php
class Versoescala extends AppModel {

	var $name = 'Versoescala';


//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Escalasmonth' => array('className' => 'Escalasmonth',
								'foreignKey' => 'escalasmonth_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>