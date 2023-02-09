<?php
class Especialidade extends AppModel {
    
	var $displayField = 'nm_especialidade';
	var $name = 'Especialidade';
	var $order = 'Especialidade.nm_especialidade asc';


//	var $actsAs = array('Logable'); 
		//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Quadro' => array('className' => 'Quadro',
								'foreignKey' => 'quadro_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'especialidade_id',
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