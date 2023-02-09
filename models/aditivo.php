<?php
class Aditivo extends AppModel {

	var $name = 'Aditivo';
	//var $useTable = false;

	var $belongsTo = array(
            'Aditivosplanoset' => array('className' => 'Aditivosplanoset',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
            'Aditivosplanorvsm' => array('className' => 'Aditivosplanorvsm',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
            'Aditivosplanotrecho' => array('className' => 'Aditivosplanotrecho',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
            'Aditivosplanosetor' => array('className' => 'Aditivosplanosetor',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
           'Aditivosplano' => array('className' => 'Aditivosplano',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
         'Aditivosplanodia' => array('className' => 'Aditivosplanodia',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
          'Aditivosplanohora' => array('className' => 'Aditivosplanohora',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
          'NivelInglesFase02' => array('className' => 'NivelInglesFase02',
                                'foreignKey' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
           'Habilitacao' => array('className' => 'Habilitacao',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
				'Unidade' => array('className' => 'Unidade',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
				'Membrosconselho' => array('className' => 'Membrosconselho',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Atividadelicenca' => array('className' => 'Atividadelicenca',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Empresa' => array('className' => 'Empresa',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
								
			'Cargosconselho' => array('className' => 'Cargosconselho',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => 'Setor.sigla_setor asc'
								),
			'Instituicaoensino' => array('className' => 'Instituicaoensino',
								'foreignKey' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
			,
			'Motivosuspensao' => array('className' => 'Motivosuspensao',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Qualificacao' => array('className' => 'Qualificacao',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Boletiminterno' => array('className' => 'Boletiminterno',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Setor' => array('className' => 'Setor',
								'foreignKey' => false,
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
            'Ata' => array('className' => 'Ata',
                                'foreignKey' => false,
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                ),
            'Posto' => array('className' => 'Posto',
                                'foreignKey' => false,
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ' Posto.antiguidade asc '
                                ),
            'Especialidade' => array('className' => 'Especialidade',
                                'foreignKey' => false,
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                                )
                                
                                
	);
        
	
        
	
}
?>
