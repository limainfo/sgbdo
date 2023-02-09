<?php
class Rotina extends AppModel {

	var $name = 'Rotina';
	var $displayField = 'acao';
	var $validate = array(
		'doc_referencia' => array(
	    		'minlength' => array(
		        	'rule' => array('minLength', '4'),
        			'message' => 'Mínimo de 4 caracteres'
     				)
				),
		'dt_referencia' => array(
  							 'rule' => array('date'=>'dmy'),
 							 'message' => 'Data de referência não pode estar em branco e estar no forma dia-mes-Ano.',
   							'allowEmpty' => false
				
				),
				'acao' => array(
	    		'minlength' => array(
		        	'rule' => array('minLength', '4'),
        			'message' => 'Mínimo de 4 caracteres'
     				)
				),
				
		'ativa' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*
			'Orgao' => array('className' => 'Orgao',
								'foreignKey' => 'orgao_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
	 * 	 */
	var $belongsTo = array(
			'Setor' => array('className' => 'Setor',
								'foreignKey' => 'setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Periodicidade' => array('className' => 'Periodicidade',
								'foreignKey' => 'periodicidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Calendariorotina' => array('className' => 'Calendariorotina',
								'foreignKey' => 'rotina_id',
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