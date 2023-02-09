<?php
class Indicadoscurso extends AppModel {

	var $name = 'Indicadoscurso';
	var $order = "Indicadoscurso.prioridade asc ";
//, Curso.codigo asc
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	//var $actsAs = array('Logable'); 
	var $belongsTo = array(
			'Cursoativo' => array('className' => 'Cursoativo',
								'foreignKey' => 'cursoativo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Curso' => array('className' => 'Curso',
								'foreignKey' => false,
								'conditions' => 'Cursoativo.curso_id=Curso.id',
								'fields' => '',
								'order' => ''
			),
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Especialidade' => array('className' => 'Especialidade',
								'foreignKey' => false,
								'conditions' => 'Militar.especialidade_id=Especialidade.id',
								'fields' => '',
								'order' => 'Especialidade.nm_especialidade asc'
								),
									
			'Setor' => array('className' => 'Setor',
								'foreignKey' => false,
								'conditions' => 'Militar.setor_id=Setor.id',
								'fields' => '',
								'order' => 'Setor.sigla_setor asc'
								),
			'Posto' => array('className' => 'Posto',
								'foreignKey' => false,
								'conditions' => 'Militar.posto_id=Posto.id',
								'fields' => '',
								'order' => ''
								)
			
	);
var $hasOne = array(
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => 'Setor.unidade_id = Unidade.id',
								'fields' => '',
								'order' => ''
								),
			'Quadro' => array('className' => 'Quadro',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => 'Especialidade.quadro_id = Quadro.id',
								'fields' => '',
								'order' => ''
								)
								);

	

}
?>