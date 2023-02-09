<?php
class Militar extends AppModel {
	var $displayField = 'nm_completo';


	var $name = 'Militar';
	//var $validate = array('identidade' => array('alphanumeric')	);

	//var $actsAs = array('Logable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Especialidade' => array('className' => 'Especialidade',
								'foreignKey' => 'especialidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Especialidade.nm_especialidade asc'
								),
									
			'Setor' => array('className' => 'Setor',
								'foreignKey' => 'setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Setor.sigla_setor asc'
								),
			'Posto' => array('className' => 'Posto',
								'foreignKey' => 'posto_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
			,
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => 'unidade_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								,
			'Quadro' => array('className' => 'Quadro',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => 'Especialidade.quadro_id=Quadro.id',
								'fields' => '',
								'order' => ''
								)
								);

	var $hasOne = array(
			'Foto' => array('className' => 'Foto',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Assinatura' => array('className' => 'Assinatura',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);
/*
 * 
   ,
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
 */
		var $hasMany = array(
			'Afastamento' => array('className' => 'Afastamento',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Atividade' => array('className' => 'Atividade',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Exame' => array('className' => 'Exame',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Habilitacao' => array('className' => 'Habilitacao',
								'foreignKey' => 'militar_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Paeatsindicado' => array('className' => 'Paeatsindicado',
								'foreignKey' => 'militar_id',
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

	var $hasAndBelongsToMany = array(
			'Curso' => array('className' => 'Curso',
						'joinTable' => 'militars_cursos',
						'foreignKey' => 'militar_id',
						'associationForeignKey' => 'curso_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => 'MilitarsCurso.dt_inicio_curso asc',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
						),
			'Escala' => array('className' => 'Escala',
						'joinTable' => 'militars_escalas',
						'foreignKey' => 'militar_id',
						'associationForeignKey' => 'escala_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
						)
						);

	function mudaDBModelo($database='db2'){
		$this->unbindModel(array('hasAndBelongsToMany'=>array('Escala','Curso'), 'hasOne'=>array('Assinatura','Unidade','Quadro','Foto'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao'),'belongsTo'=>array('Setor','Especialidade','Posto')));
		parent::setDataSource($database);
		parent::__construct();
	}
	
						
}
?>