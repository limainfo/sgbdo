<?php
class Testeopprovasagendada extends AppModel {
	var $displayField = 'ano';


	var $name = 'Testeopprovasagendada';


	var $belongsTo = array(
			'Especialidade' => array('className' => 'Especialidade',
								'foreignKey' => 'especialidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Especialidade.nm_especialidade asc'
								),
									
			
			'Testeopprova' => array('className' => 'Testeopprova',
								'foreignKey' => 'testeopprova_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
			
	);

						
}
?>