<?php
class Setor extends AppModel {

	var $name = 'Setor';
	var $displayField='sigla_setor';
	var $order = 'Setor.sigla_setor asc';
//	var $order = 'sigla_setor';
	
	var $validate = array(
		'efetivo_previsto' => array('numeric'),
		'sigla_setor' => array('rule' => array('minLength', 2), 'message' => 'O campo deve ter no nínimo 3 caracteres!')
	);
/*
,
            
                        'Parentsetor' =>array( 'className' => 'Setor' ,
                                                                'foreignKey' => 'parent_id'
                                                                )
                      'Childsetor' =>array( 'className' => 'Setor' ,
                                                                'foreignKey' => 'parent_id'
                                                                ),
			
* 
 *  */
//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => 'unidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Unidade.sigla_unidade asc'
			)
                        );

	var $hasMany = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'setor_id',
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
								'foreignKey' => 'setor_id',
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
/*
 * 'Setoresassociado' => array('className' => 'Setoresassociado',
								'foreignKey' => 'setor_id',
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
 */
?>