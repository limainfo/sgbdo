<?php

class HabilitacaosController extends AppController {

    var $name = 'Habilitacaos';
    var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

    function index() {

        $this->Habilitacao->Militar->unbindModel(array('belongsTo' => array('Unidade', 'Quadro'), 'hasOne' => array('Foto', 'Assinatura'), 'hasMany' => array('Atividade', 'Exame', 'Afastamento', 'Habilitacao', 'Paeatsindicado'), 'hasAndBelongsToMany' => array('Curso', 'Escala')), false);
        $this->Habilitacao->recursive = 0;
        $sqlvencidas = ' datediff(Habilitacao.validade_cht, now())<0 ';
        $sql1mes = ' datediff(Habilitacao.validade_cht, now())>0 and datediff(Habilitacao.validade_cht, now())<=30 ';
        $sql2meses = ' datediff(Habilitacao.validade_cht, now())>30 and datediff(Habilitacao.validade_cht, now())<=60 ';
        $sqlsuspensa = ' Habilitacao.dt_suspensao>0 and Habilitacao.motivo_suspensao is not null ';
        $sqlperda = ' Habilitacao.dt_perda>0 and Habilitacao.motivo_perda is not null ';
        //$this->Habilitacao->find('all');
        $habilitacaosvencidas = $this->Habilitacao->find('all', array('conditions' => array($sqlvencidas), 'order' => array('Habilitacao.validade_cht asc')));
        $habilitacaos1mes = $this->Habilitacao->find('all', array('conditions' => array($sql1mes), 'order' => array('Habilitacao.validade_cht asc')));
        $habilitacaos2meses = $this->Habilitacao->find('all', array('conditions' => array($sql2meses), 'order' => array('Habilitacao.validade_cht asc')));
        $habilitacaossuspensas = $this->Habilitacao->find('all', array('conditions' => array($sqlsuspensa), 'order' => array('Habilitacao.validade_cht asc')));
        $habilitacaosperdas = $this->Habilitacao->find('all', array('conditions' => array($sqlperda), 'order' => array('Habilitacao.validade_cht asc')));
        $total = count($this->Habilitacao->find('all'));
        //print_r($habilitacaos);exit();

        $findUrl = decodeURIComponent($this->data['formFind']['find']);
        $findUrl = str_replace('||', '%', $findUrl);
        $opcoes = $findUrl;
        $esquema = $this->Habilitacao->_schema;
        $this->set('esquema', $esquema);
        $habilitacaosconsultadas = $this->Habilitacao->find('all', array('conditions' => array($opcoes), 'order' => array('Habilitacao.validade_cht asc')));


        $this->set(compact('habilitacaosvencidas', 'habilitacaos1mes', 'habilitacaos2meses', 'habilitacaossuspensas', 'habilitacaosperdas', 'total', 'habilitacaosconsultadas'));
    }

    function view($id = null) {
        $this->layout = 'admin';
        $this->Habilitacao->recursive = 2;

        if (!$id) {
            $this->Session->setFlash(__('<h1><font color="red">Valor inválido para  Habilitacao.</font></h1>', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('habilitacao', $this->Habilitacao->read(null, $id));

//        // Mudado por izilbert
//        $habilitacao = $this->Habilitacao->read(null, $id);
//        $historico = $this->Habilitacao->Historico->query("select * from historicos where idHabilitacao='".$habilitacao['Habilitacao']['id']."'");
        //print_r($this->Habilitacao->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Habilitacao->create();
            if ($this->Habilitacao->save($this->data)) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $u = $this->Session->read('Usuario');
                $usuario = $u[0][0]['nome'];

                foreach ($this->data['Habilitacao'] as $chave => $valor) {
                    $mudanca .= '[' . $chave . ']=' . $valor . ' ,';
                }
                $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Habilitacao",now(),"Habilitacao", "Add","' . $usuario . '", "' . $ip . '", "' . $mudanca . '")';
                $this->Habilitacao->query($monitora);

                $this->Session->setFlash(__('Os dados de  Habilitacao foram gravados.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Os dados de Habilitacao não foram gravados. Por favor, tente novamente.', true));
            }
        }
        $sql1 = "select  Militar.id  , concat( Militar.nm_completo, ' - ', Posto.sigla_posto)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade,Militar.nm_completo asc";

        $militars = $this->Habilitacao->Militar->query($sql1);

        foreach ($militars as $milico) {
            $vetor[] = $milico['Militar']['id'];
            $vetor2[] = $milico[0]['Militar.nm_completo'];
        }
        $militars = array_combine($vetor, $vetor2);

        $atas = $this->Habilitacao->Ata->find('list');
        $boletiminternos = $this->Habilitacao->Boletiminterno->find('list');
        $atas[0] = 'Selecione a Unidade';
        $boletiminternos[0] = 'Selecione a Unidade';


        $this->set(compact('militars', 'atas', 'boletiminternos'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Habilitacao', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if (!empty($this->data['Habilitacao']['dt_suspensao']) && !empty($this->data['Habilitacao']['motivo_suspensao'])) {
                $u = $this->Session->read('Usuario');
                $usuario = $u[0][0]['nome'];
                $this->data['Habilitacao']['responsavel_suspensao'] = $usuario;
            }
            if (!empty($this->data['Habilitacao']['dt_perda']) && !empty($this->data['Habilitacao']['motivo_perda'])) {
                $u = $this->Session->read('Usuario');
                $usuario = $u[0][0]['nome'];
                $this->data['Habilitacao']['responsavel_perda'] = $usuario;
            }
            if ($this->Habilitacao->save($this->data)) {
                $ip = $_SERVER['REMOTE_ADDR'];
                $u = $this->Session->read('Usuario');
                $usuario = $u[0][0]['nome'];

                foreach ($this->data['Habilitacao'] as $chave => $valor) {
                    $mudanca .= '[' . $chave . ']=' . $valor . ' ,';
                }
                $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Habilitacao",now(),"Habilitacao", "Edit","' . $usuario . '", "' . $ip . '", "' . $mudanca . '")';
                $this->Habilitacao->query($monitora);

                $this->Session->setFlash(__('Os dados de Habilitacao foram gravados.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Os dados de Habilitacao não foram gravados. Por favor, tente novamente.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Habilitacao->read(null, $id);
        }
        $sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade,Militar.nm_completo asc";

        $militars = $this->Habilitacao->Militar->query($sql1);

        foreach ($militars as $milico) {
            $vetor[] = $milico['Militar']['id'];
            $vetor2[] = $milico[0]['Militar.nm_completo'];
        }
        $militars = array_combine($vetor, $vetor2);
        $atas = $this->Habilitacao->Ata->find('list');
        $boletiminternos = $this->Habilitacao->Boletiminterno->find('list');
        $atas[0] = 'Selecione a Unidade';
        $boletiminternos[0] = 'Selecione a Unidade';


        $this->set(compact('militars', 'atas', 'boletiminternos'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('ID inválido para Habilitacao', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Habilitacao->delete($id)) {
            $this->Session->setFlash(__('Habilitacao excluído', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function indexPdf($id = null) {
        $this->layout = 'pdf'; //this will use the pdf.thtml layout
        $this->Habilitacao->recursive = 2;
        $this->Habilitacao->Militar->unbindModel(array('belongsTo' => array('Quadro'), 'hasOne' => array('Foto', 'Assinatura'), 'hasMany' => array('Atividade', 'Exame', 'Afastamento', 'Habilitacao', 'Paeatsindicado'), 'hasAndBelongsToMany' => array('Curso', 'Escala')), false);
        $this->Habilitacao->Militar->bindModel(array('hasOne' => array('Licenca' => array('foreignKey' => false, 'dependent' => false, 'conditions' => array('Licenca.militar_id=Militar.id')))));
        $this->Habilitacao->Militar->bindModel(array('hasOne' => array('NivelInglesFase02' => array('foreignKey' => false, 'dependent' => false, 'conditions' => array('NivelInglesFase02.militar_id=Militar.id'),'limit'=>'1','order'=>array('dt_realizacao'=>'desc')))));
        $habilitacaos = $this->Habilitacao->read(null, $id);
        $this->set(compact('habilitacaos'));
//		pr($habilitacaos);exit();
        $this->render();
    }

    function externoRevalidar($id) {
        $this->Habilitacao->recursive = 2;
        if (empty($this->data)) {
            $this->layout = 'admin';
            $this->data = $this->Habilitacao->read(null, $id);
            $this->data['Habilitacao']['nm_completo'] = $this->data['Militar']['Posto']['sigla_posto'] . " " . $this->data['Militar']['Especialidade']['nm_especialidade'] . " " . $this->data['Militar']['nm_completo'];
        } else {
            // Grava a revalidacao
            $historico = $this->Habilitacao->read(null, $id);
            $this->Habilitacao->save($this->data);
            //Atualizacao para gravacao de historico
            $this->Habilitacao->Historico->create();
            // Busca o usuario
            $u = $this->Session->read('Usuario');
            $usuarioNome = $u[0][0]['nome'];
            $historico['Habilitacao']['habilitacao_id'] = $id;
            unset($historico['Habilitacao']['id']);
            $historico['Habilitacao']['nomeUsuario'] = $usuarioNome;
            $historico['Habilitacao']['dataAlteracao'] = date_create(); //date("Y-m-d h:i:s");
            // Salva o Historico
            if (( strtotime($this->data['Habilitacao']['validade_cht']) >= strtotime($historico['Habilitacao']['validade_cht']) ) && ( strtotime($this->data['Habilitacao']['dt_concesssao']) >= strtotime($historico['Habilitacao']['dt_concessao']) )) {
                if ($this->Habilitacao->Historico->save($historico['Habilitacao'])) {
                    $this->Session->setFlash(__('<h1>Os dados de Habilita&ccedil;&atilde;o foram Revalidados com Sucesso!</h1>', true));
                    $this->set('habilitacao', $this->Habilitacao->read(null, $id));
                    $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('<font color="red"><h1>Os dados de Revalida&ccedil;&atilde;o de Habilitacao n&atilde;o foram gravados. Por favor, tente novamente.</h1></font>', true));
                }
            } else {
                $this->Session->setFlash(__('<font color="red"><h1>Por favor, verifique os dados de data de concessão e data de validação.</h1></font>', true));
            }
        }
    }

    function externoanexoa() {
        $this->render();
    }

    function externoanexob() {
        $this->render();
    }

    function externoanexoc() {
        $this->render();
    }

    function externoanexod() {
        $this->render();
    }

    function externocontrole() {
        $this->render();
    }

}

?>