<?php
class Livroeletronico extends AppModel {
	var $displayField = 'nm_livro';


	var $name = 'Livroeletronico';
	var $validate = array();

		var $hasMany = array(
			'Livroposicao' => array('className' => 'Livroposicao',
								'foreignKey' => 'livroeletronico_id',
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