<?php
/* SVN FILE: $Id: app_controller.php 4410 2007-02-02 13:31:21Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4410 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:31:21 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake
 */

class AppController extends Controller {

	/**
	 * 'Acl' needs to be requested prior to 'Auth'
	 */
	//'Javascript'
//	var $helpers = array('Js' => array('Prototype'),'Html','Form','Ajax','Calendar','Pdf','DatePicker','Openoffice','Csv','Session','Easyzip');
	var $helpers = array('Js' => array('Prototype'),'Html','Form','Session','Ajax','Pdf','Openoffice','Csv','Easyzip','DatePicker');
        //,'Crypt'
	var $components = array('Session','RequestHandler');
//	var $components = array('Session','Cookie','RequestHandler');
	//var $components = array('RequestHandler','Session');
//	var $components = array('Cookie','RequestHandler');
	//var $components = array('Cookie','Domini','RequestHandler');
	//var $components = array();
	var $paginate = array('limit'=>15);
	public $alias = 'Usuario';
	public $primaryKey = 'id';
	public $nome = 'usuario_nome';
	public $displayField = '';
	
	public $pathAditivos;
	
    public $arvore;

    
	var $persistModel = true;	
    /**
     * _encrypt()
     *
     * @param mixed $data
     * @return string
     */
        
  function beforeRender() {

      foreach($this->modelNames as $model) {
      foreach($this->$model->_schema as $var => $field) {
        if(strpos($field['type'], 'enum') === FALSE)
          continue;

        preg_match_all("/\'([^\']+)\'/", $field['type'], $strEnum);

        if(is_array($strEnum[1])) {
          $varName = Inflector::camelize(Inflector::pluralize($var));
          $varName[0] = strtolower($varName[0]);
          $this->set($varName, array_combine($strEnum[1], $strEnum[1]));
        }
      }
    }

 
  }         


	function beforeFilter() {
		$this->arvore=array('CMD'=>array(),'DA'=>array(),'DO'=>array('AIS','ATM','COM','MET','OPG','OPM','SAR'),'DT'=>array());
		$this->pathAditivos = str_replace('controllers','views/aditivos/aditivos.php',substr(__FILE__, 0, strrpos(__FILE__, '/')));
		
		$this->set('caminhoAditivos',$this->pathAditivos);
		$p=$this->Session->read('Privilegio');
		$u=$this->Session->read('Usuario');
                
		
		//print_r($modPerfil);
		
		$this->set('min_registros',5);
		$this->set('max_registros',30);
		$this->set('passo',5);

		//echo '<br><br>';print_r($u);
		// $activeUser = array( $this->alias => array( $this->primaryKey => $u[0]['Usuario']['id'], $this->displayField => $u[0][0]['nome']));  		
		 $activeUser = array( $this->alias => array( $this->primaryKey => $u[0]['Usuario']['id'], $this->displayField => $u[0][0]['nome'], $this->nome => $u[0][0]['nome']));  		
		 
		 //print_r($activeUser);
		 
		 //if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {$this->{$this->modelClass}->setUserData($activeUser);}
		
		//print_r($p);
//echo $this->name.'<br>';
		
		if(!empty($u[0]['Usuario'])){
			if ($this->action != 'view') {
				$this->layout = 'admin';
				$this->checkAdmin();
			}else{
				//$this->set('k',$u);
				foreach($p as $priv){
					$vetor[]=$priv['Tabela']['tabela'];
					$vetor2[]=$priv['PrivilegiosTabela']['ver'].$priv['PrivilegiosTabela']['editar'].$priv['PrivilegiosTabela']['adicionar'].$priv['PrivilegiosTabela']['deletar'];
				}
				$acesso=array_combine($vetor,$vetor2);
				$this->set(compact('acesso','u'));
				$this->layout = 'default';
			}
//echo '<br><br>';print_r($u);
                        /*
			if($this->name=='Ocorrencias'){
				Configure::write('debug',2);
			}
			if($this->name=='Afastamentos'){
				Configure::write('debug',0);
			}
			if(($this->name=='Escalas')&&($this->action=='externoPdf')){
				//Configure::write('debug',2);
			}
                         * 
                         */
		}else{
			
			if(!((preg_match('/^externo/',$this->action))||($this->action=='indexPdf'))){
				$this->redirect('/usuarios/logout',null,true);
			}

		}

		
		//echo "<br><br><br>".$this->name;
	}

	function checkAdmin() {

		$p=$this->Session->read('Privilegio');
		$u=$this->Session->read('Usuario');


		
		$bca=$this->Session->read('Bca');
		//$this->set('k',$u);
		foreach($p as $priv){
			$vetor[]=$priv['Tabela']['tabela'];
			$vetor2[]=$priv['PrivilegiosTabela']['ver'].$priv['PrivilegiosTabela']['editar'].$priv['PrivilegiosTabela']['adicionar'].$priv['PrivilegiosTabela']['deletar'];
		}
		$acesso=array_combine($vetor,$vetor2);

		$this->set(compact('acesso','u','bca'));

//		print_r($acesso);



		//if (($this->name<>'Calendariorotinas')&&!(($u[0]['Usuario']['privilegio_id']!=2)&&(($this->action=='ajax')||($this->action=='ajaxdelete')||($this->action=='ajaxdelmil')||($this->action=='indexPdf')||($this->action=='indexExcel')||($this->action=='update')||($this->action=='download')||($this->action=='login')||($this->action=='ldap')||((preg_match('/^externo/',$this->action)))||($this->action=='securimage')||($this->action=='verso')||($this->action=='assinar')||($this->action=='relatorioPdf')||($this->action=='broffice')))){
		if (($this->name<>'Calendariorotinas')&&!((($this->action=='ajax')||($this->action=='ajaxdelete')||($this->action=='ajaxdelmil')||($this->action=='indexPdf')||($this->action=='indexExcel')||($this->action=='update')||($this->action=='download')||($this->action=='login')||($this->action=='loginMuda')||($this->action=='ldap')||((preg_match('/^externo/',$this->action)))||($this->action=='securimage')||($this->action=='verso')||($this->action=='assinar')||($this->action=='relatorioPdf')||($this->action=='broffice')))){
			if (!$this->Session->check('Usuario')) {
				$this->Session->setFlash('É necessário estar logado.');
				unset($u);
				unset($acesso);
				$this->Session->delete('Usuario');
				$this->Session->delete('Privilegio');
				$this->redirect('/usuarios/logout',null,true);
			}else{
				$f=0;

                            if(count($p)>1){
				foreach($p as $privilegio){

                                    if(str_replace('_','',$privilegio['Tabela']['tabela'])==strtolower($this->name)){
                                        if($this->action=='view'){
                                                if($privilegio['PrivilegiosTabela']['ver']){
                                                        $f=1;
                                                        break;
                                                }
                                        }
                                        if($this->action=='edit'){
                                                if($privilegio['PrivilegiosTabela']['editar']){
                                                        $f=1;
                                                        break;
                                                }
                                        }
                                        if($this->action=='add'){
                                                if($privilegio['PrivilegiosTabela']['adicionar']){
                                                        $f=1;
                                                        break;
                                                }
                                        }
                                        if(($this->action=='del')||($this->action=='delete')){
                                                if($privilegio['PrivilegiosTabela']['deletar']){
                                                        $f=1;
                                                        break;
                                                }
                                        }
                                        if($this->action=='index'){
                                                $f=1;
                                                break;
                                        }
                                        if((($this->action=='ajaxdelete')||($this->action=='ajax')||($this->action=='ajaxdelmil')||($this->action=='ldap')||($this->action=='geraescala'))&&($u[0]['Usuario']['privilegio_id']!=2)){
                                                $f=1;
                                                break;
                                        }
                                        if(($this->action=='externoindex')||($this->action=='externoview')||($this->action=='externocalendario')||($this->action=='externoespelho')||($this->action=='externoupdateano')||($this->action=='externoupdatemilitar')||($this->action=='externopdfcalendario')||($this->action=='externoupdateescalas')||($this->action=='externoupdatedias')||($this->action=='externoespelhopdf')||($this->action=='indexPdf')||($this->action=='indexExcel')||($this->action=='download')||($this->action=='login')||($this->action=='loginMuda')||($this->action=='zera')||($this->action=='escala')){
                                                $f=1;
                                                break;
                                        }


                                    }
					
				}
                            }
				//echo '<br><br><br>'.$this->name.'  '.$this->action.' '.$u[0]['Usuario']['id'];
				//print_r($this->data);exit();
				if(($this->name=='Usuario')&&($this->action=='edit')){
					$this->data['Usuario']['id']=$u[0]['Usuario']['id'];
				}
				

				if(($this->name!='Usuario')&&($this->action!='edit')){
					$senha=0;
					if($f){
						//$usuario=  ClassRegistry::init('Usuario');
						$this->loadModel('Usuario');
						$verificasenha=$this->Usuario->query("select id, militar_id, privilegio_id from usuarios where id={$u[0]['Usuario']['id']} and senha=(select md5(saram) from militars where id='{$u[0]['Usuario']['militar_id']} ') ");
						//echo "<br><br><br>select id, militar_id, privilegio_id from usuarios where id={$u[0]['Usuario']['id']} and senha=(select md5(saram) from militars where id='{$u[0]['Usuario']['militar_id']} ') ";
						//print_r($verificasenha);
						if(!empty($verificasenha[0]['usuarios']['id'])){
							$senha=1;
						}
					
						if($senha==1){
							$this->Session->setFlash('É obrigatório mudar a senha! Não pode ser o SARAM.');
							$this->redirect('/usuarios/edit/'.$verificasenha[0]['usuarios']['id'],null,true);
						}
					}
				}
				if(!$f){
					
					if(empty($u[0]['Privilegio']['inicio'])){
						$this->Session->setFlash('É necessário estar logado.');
						$this->loadModel('Usuario');
                                                $this->Usuario->query("delete from cake_sessions where data like '%{$usuario[0][0]['nome']}%'");
                                                
						$this->redirect('/usuarios/logout',null,true);

					}else{
						$this->Session->setFlash('Última operação não foi realizada. Motivo: Seu usuário não possui permissão. Faça contato com o planejamento.');
						$this->redirect('/'.$u[0]['Privilegio']['inicio'],null,true);
					}
				}
				
			}



		}

	}


}
?>