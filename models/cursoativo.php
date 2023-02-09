<?php
class Cursoativo extends AppModel {

	var $name = 'Cursoativo';
	var $displayField = 'curso_id';
	var $validate = array(
	'curso_id' => array('rule'=>'numeric','message'=>'Campo deve ser numérico'),
	'turma' => array('rule'=>array('minLength', '3'),'message'=>'Campo com no mínimo 3 caracteres'),
	'data_inicio' => array('rule'=> array('custom', '/^\d{2}\-\d{2}\-\d{4}$/i'), 'message' => 'Data no formato dd-mm-yyyy'	),
	'data_termino' => array('rule'=> array('custom', '/^\d{2}\-\d{2}\-\d{4}$/i'), 'message' => 'Data no formato dd-mm-yyyy'	),
	'vagas' => array('rule'=>array('range',0,100),'message'=>'Campo deve ser numérico e maior que zero.')
	);
	
	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Curso' => array('className' => 'Curso',
								'foreignKey' => 'curso_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Tipocurso' => array('className' => 'Tipocurso',
								'foreignKey' => 'tipocurso_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
			);

	var $hasMany = array(
			'Indicadoscurso' => array('className' => 'Indicadoscurso',
								'foreignKey' => 'cursoativo_id',
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