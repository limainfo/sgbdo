<?php
class Orgao extends AppModel {

	var $name = 'Orgao';
	var $displayField = 'sigla_orgao';
	var $order = 'Orgao.sigla_orgao asc';
	
	var $validate = array(
		'sigla_orgao' => array('rule' => array('minLength', '4'),
    'message' => 'Mínimo de 4 caracteres')	);

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => 'unidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
/*
 * 			'Atividade' => array('className' => 'Atividade',
								'foreignKey' => 'orgao_id',
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
			'Escala' => array('className' => 'Escala',
								'foreignKey' => 'orgao_id',
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
 	var $hasMany = array(

			'Rotina' => array('className' => 'Rotina',
								'foreignKey' => 'orgao_id',
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
*/

}
?>