<?php
class CursosSetor extends AppModel {

	var $name = 'CursosSetor';


	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'EspecialidadesSetor' => array('className' => 'EspecialidadesSetor',
								'foreignKey' => 'especialidades_setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Curso' => array('className' => 'Curso',
								'foreignKey' => 'curso_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
	);

}
?>