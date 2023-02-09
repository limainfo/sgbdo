<?php
class Escala extends AppModel {

	var $name = 'Escala';
	//var $actAs = array('Linkable');

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
				'Setor' => array(
						'className' => 'Setor',
						'foreignKey' => 'setor_id',
						'link' => array('Unidade' => 'Localidade'),
						'conditions' => '',
						'fields' => '',
    					'recursive'=>2,  
						'order' => ''
						)
	);
						


			var $hasMany = array(
			'Escalasmonth' => array('className' => 'Escalasmonth',
								'foreignKey' => 'escala_id',
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
			'MilitarsEscala' => array('className' => 'MilitarsEscala',
								'foreignKey' => 'escala_id',
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
			'Turno' => array('className' => 'Turno',
								'foreignKey' => 'escala_id',
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
			'Militar' => array('className' => 'Militar',
						'joinTable' => 'militars_escalas',
						'foreignKey' => 'escala_id',
						'associationForeignKey' => 'militar_id',
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



						/*
						 * ,
						'link' => array('Unidade' => array('Localidade')),
,
				'Unidade'=>array(
						'className' => 'Unidade',
						'foreignKey' => false,
						'conditions' => array(array('Setor.unidade_id=Unidade.id')),
						'fields' => '',
						'order' => ''
						),
				'Localidade' => array(
						'className' => 'Localidade',
						'foreignKey' => false,
						'conditions' => array(array('Unidade.localidade_id=Localidade.id')),
						'fields' => '',
						'order' => 'Localidade.sigla_localidade,Unidade.sigla_unidade,Setor.sigla_setor'
						)
						
												  
						 var $hasOne = array(
						 'Setor' => array('className' => 'Setor',
						 'foreignKey' => 'setor_id',
						 'conditions' => '',
						 'fields' => '',
						 'order' => 'Setor.sigla_setor asc'
						 )
						 'Setor' => array('className' => 'Setor',
						 'foreignKey' => false,
						 'conditions' => array('1=1',array('Escala.setor_id=Setor.id')),
						 'fields' => '',
						 'order' => 'Setor.sigla_setor asc'
						 ),
						 'Unidade'=>array('className' => 'Unidade',
						 'foreignKey' => false,
						 'conditions' => array('1=1',array('Setor.unidade_id=Unidade.id')),
						 'fields' => '',
						 'order' => 'Unidade.sigla_unidade asc'
						 ),
						 'Localidade' => array('className' => 'Localidade',
						 'foreignKey' => false,
						 'conditions' => array('1=1',array('Unidade.localidade_id=Localidade.id')),
						 'fields' => '',
						 'order' => 'Localidade.sigla_localidade asc'
						 )


						 );

						 */
						
}
?>