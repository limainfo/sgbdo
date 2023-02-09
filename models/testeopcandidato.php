<?php
class Testeopcandidato extends AppModel {
	var $displayField = 'nm_candidato';


	var $name = 'Testeopcandidato';

	var $belongsTo = array(
			'Testeopprovasagendada' => array('className' => 'Testeopprovasagendada',
								'foreignKey' => 'testeopprovasagendada_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Setor' => array('className' => 'Setor',
								'foreignKey' => 'setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Setor.sigla_setor asc'
								),
			'Unidade' => array('className' => 'Unidade',
								'foreignKey' => 'unidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
			);

						
}
?>