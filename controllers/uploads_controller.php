<?php

class UploadsController extends AppController {

    var $name = 'Uploads';

    function index() {
        uses('sanitize');
        $sanitize = new Sanitize();
        $this->set('findUrlNotCleaned',
        trim($this->data['formFind']['find']));
        $this->cleanData = $sanitize->clean($this->data );
        $findUrl = low(trim($this->cleanData['formFind']['find']));
        if ( $findUrl != '' ) {
            $this->Upload->recursive = 1;
            $opcoes = "LOWER(`Upload`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Upload`.``) LIKE '%" . $findUrl ."%' ";
            if(!empty($this->data['formFind']['paginas'])){
                if($this->data['formFind']['paginas']=='TODAS'){
                    $registros = $this->Upload->find('all',$opcoes);
                    $qtdPaginas = $this->data['formFind']['paginas'];
                    $this->data['formFind']['paginas'] = count($registros);
                }
                $this->paginate['limit'] = $this->data['formFind']['paginas'];
            }
            $this->data['formFind']['paginas'] = $this->paginate['limit'];
            $this->Upload->recursive = 1;
            $this->set('uploads', $this->paginate('Upload',array("LOWER(`Upload`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Upload`.``) LIKE '%" . $findUrl ."%' ")));
        } else {
            $this->Upload->recursive = 1;
            if(!empty($this->data['formFind']['paginas'])){
                if($this->data['formFind']['paginas']=='TODAS'){
                $registros = $this->Upload->find('all',$opcoes);
                $qtdPaginas = $this->data['formFind']['paginas'];
                $this->data['formFind']['paginas'] = count($registros);
            }
            $this->paginate['limit'] = $this->data['formFind']['paginas'];
        }
        $this->data['formFind']['paginas'] = $this->paginate['limit'];
        $this->Upload->recursive = 1;
        $this->set('uploads', $this->paginate());
        }
    }

    function view($id = null) {
        $this->layout = 'admin';
        if (!$id) {
            $this->Session->setFlash(__('Registro da tabela upload não encontrado.', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('upload', $this->Upload->read(null, $id));
    }

    function add() {
        if (!empty($this->data) &&
             is_uploaded_file($this->data['Upload']['File']['tmp_name'])) {
            $fileData = fread(fopen($this->data['Upload']['File']['tmp_name'], "r"),
                                     $this->data['Upload']['File']['size']);

            $this->data['Upload']['name'] = $this->data['Upload']['File']['name'];
            $this->data['Upload']['type'] = $this->data['Upload']['File']['type'];
            $this->data['Upload']['size'] = $this->data['Upload']['File']['size'];
            $this->data['Upload']['data'] = $fileData;

            $this->Upload->save($this->data);

            //$this->redirect('somecontroller/someaction');
            $this->Session->setFlash(__('Os dados para a tabela upload foram armazenados.', true));
            $this->redirect(array('action' => 'index'));

             } else {
                $this->Session->setFlash(__('Os dados para a tabela upload não foram armazenados. Corrija os dados e tente novamente.', true));
            }
        }
    

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Registro da tabela upload não encontrado.', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
        
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $u = $this->Session->read('Usuario');
        $usuario = $u[0][0]['nome'];

        $consultalog = 'select * from uploads Upload where Upload.id='.$id;
        $dadoslog=$this->Upload->query($consultalog);
        $mudanca = "Antes:";
        foreach($dadoslog[0]['Upload'] as $chave=>$valor){
            $mudanca .= '['.$chave.']='.$valor.' ,';
        }
        $mudanca .= "Depois:";
        foreach($this->data['Upload'] as $chave=>$valor){
            $mudanca .= '['.$chave.']='.$valor.' ,';
        }
        $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Upload",now(),"Upload", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
        $this->Upload->query($monitora);
        
        
        
            if ($this->Upload->save($this->data)) {
                $this->Session->setFlash(__('Os dados para a tabela upload foram armazenados.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Os dados para a tabela upload não foram armazenados. Corrija os dados e tente novamente.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Upload->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Registro da tabela upload não encontrado.', true));
            $this->redirect(array('action'=>'index'));
        }
        
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $u = $this->Session->read('Usuario');
        $usuario = $u[0][0]['nome'];

        $consultalog = 'select * from uploads Upload where Upload.id='.$id;
        $dadoslog=$this->Upload->query($consultalog);
        foreach($dadoslog[0]['Upload'] as $chave=>$valor){
            $mudanca .= '['.$chave.']='.$valor.' ,';
        }
        $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Upload",now(),"Upload", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
        $this->Upload->query($monitora);
        
        if ($this->Upload->delete($id)) {
            $this->Session->setFlash(__('Registro da tabela Upload excluído.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Registro da tabela Upload não foi excluído.', true));
        $this->redirect(array('action' => 'index'));
    }
}

?>