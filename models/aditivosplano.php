<?php
class Aditivosplano extends AppModel {

    var $name = 'Aditivosplano';
	var $belongsTo = array(
            'Aditivosplanofirutavfr' => array('className' => 'Aditivosplanofirutavfr',
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
                                ));


}
?>