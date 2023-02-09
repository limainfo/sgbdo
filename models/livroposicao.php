<?php
class Livroposicao extends AppModel {
	var $displayField = 'nm_livro';


	var $name = 'Livroposicao';
	var $validate = array();

		var $hasMany = array(
			'Livrocomponentes' => array('className' => 'Livrocomponentes',
								'foreignKey' => 'livroposicao_id',
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

	var $belongsTo = array(
			'Livroeletronico' => array('className' => 'Livroeletronico',
								'foreignKey' => 'livroeletronico_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

	
						
}
?>