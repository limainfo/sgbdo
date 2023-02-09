<?php
class Calendariorotina extends AppModel {

	var $name = 'Calendariorotina';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Rotina' => array('className' => 'Rotina',
								'foreignKey' => 'rotina_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>