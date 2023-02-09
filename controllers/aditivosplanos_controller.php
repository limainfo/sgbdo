<?php
class AditivosplanosController extends AppController {

    var $name = 'Aditivosplanos';
    var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');


function externoindex() {

   
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $diretorio = $dir;



    $contagem = 0;
    $vetordiretorio = $vetorarquivo = $nmarquivos = $tamanhos = array();
    $arquivos = listaarvores($diretorio, $vetordiretorio, $vetorarquivo, $contagem, $nmarquivos, $tamanhos);
   //   print_r($arquivos);
      
      foreach($vetorarquivo as $indice=>$nmarquivo){
         echo $nmarquivos[$indice].'->'.substr(strtolower($nmarquivos[$indice]),0,5).'->'.$tamanhos[$indice].'<br>';     
         
         unset($dados);
         
         if(ereg("plano",strtolower($nmarquivos[$indice]))&&ereg("setor",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanosetor->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanosetor->find('all', array('conditions'=>array('Aditivosplanosetor.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanosetor.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanosetor.nome_arquivo, Aditivosplanosetor.tamanho'), 'order'=>array('Aditivosplanosetor.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanosetor']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_string($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanosetor']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanosetor']['setor'] = $vetor2[3].'';
                           $dados['Aditivosplanosetor']['qtd'] = $vetor2[4];
                           $dados['Aditivosplanosetor']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanosetor']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanosetor']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanosetor->create();
                           if($this->Aditivosplano->Aditivosplanosetor->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo SETOR
          }
          
          if(ereg("plano",strtolower($nmarquivos[$indice]))&&ereg("hora",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanohora->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanohora->find('all', array('conditions'=>array('Aditivosplanohora.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanohora.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanohora.nome_arquivo, Aditivosplanohora.tamanho'), 'order'=>array('Aditivosplanohora.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanohora']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanohora']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanohora']['hora'] = $vetor2[3];
                           $dados['Aditivosplanohora']['qtd'] = $vetor2[4];
                           $dados['Aditivosplanohora']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanohora']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanohora']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanohora->create();
                           if($this->Aditivosplano->Aditivosplanohora->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo HORA
          }   
          if(ereg("plano",strtolower($nmarquivos[$indice]))&&ereg("rvsm",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanorvsm->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanorvsm->find('all', array('conditions'=>array('Aditivosplanorvsm.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanorvsm.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanorvsm.nome_arquivo, Aditivosplanorvsm.tamanho'), 'order'=>array('Aditivosplanorvsm.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanorvsm']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==7){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))&&((is_numeric($vetor2[5])))&&((is_numeric($vetor2[6])))){
                           $dados['Aditivosplanorvsm']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanorvsm']['aprovado'] = $vetor2[3];
                           $dados['Aditivosplanorvsm']['nao_aprovado'] = $vetor2[4];
                           $dados['Aditivosplanorvsm']['acomodado'] = $vetor2[5];
                           $dados['Aditivosplanorvsm']['especial'] = $vetor2[6];
                           $dados['Aditivosplanorvsm']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanorvsm']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanorvsm']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanorvsm->create();
                           if($this->Aditivosplano->Aditivosplanorvsm->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo RVSM
          }   
          if(ereg("plano",strtolower($nmarquivos[$indice]))&&ereg("dia",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanodia->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanodia->find('all', array('conditions'=>array('Aditivosplanodia.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanodia.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanodia.nome_arquivo, Aditivosplanodia.tamanho'), 'order'=>array('Aditivosplanodia.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanodia']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanodia']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanodia']['ativados'] = $vetor2[3];
                           $dados['Aditivosplanodia']['naoativados'] = $vetor2[4];
                           $dados['Aditivosplanodia']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanodia']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanodia']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanodia->create();
                           if($this->Aditivosplano->Aditivosplanodia->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo DIA
          }   
          if(ereg("plano",strtolower($nmarquivos[$indice]))&&ereg("trecho",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanotrecho->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanotrecho->find('all', array('conditions'=>array('Aditivosplanotrecho.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanotrecho.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanotrecho.nome_arquivo, Aditivosplanotrecho.tamanho'), 'order'=>array('Aditivosplanotrecho.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanotrecho']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==8){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_string($vetor2[3])))&&((is_string($vetor2[4])))&&((is_string($vetor2[5])))&&((is_string($vetor2[6])))&&((is_numeric($vetor2[7])))){
                           $dados['Aditivosplanotrecho']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanotrecho']['espaco'] = $vetor2[3];
                           $dados['Aditivosplanotrecho']['regra'] = $vetor2[4];
                           $dados['Aditivosplanotrecho']['aerovia'] = $vetor2[5];
                           $dados['Aditivosplanotrecho']['trecho'] = $vetor2[6];
                           $dados['Aditivosplanotrecho']['qtd'] = $vetor2[7];
                           $dados['Aditivosplanotrecho']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanotrecho']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanotrecho']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanotrecho->create();
                           if($this->Aditivosplano->Aditivosplanotrecho->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo TRECHO
          }   
          if(ereg("fir",strtolower($nmarquivos[$indice]))&&ereg("uta",strtolower($nmarquivos[$indice]))){
             $this->Aditivosplano->Aditivosplanofirutavfr->recursive = 0;
             $verificaexistencia = $this->Aditivosplano->Aditivosplanofirutavfr->find('all', array('conditions'=>array('Aditivosplanofirutavfr.nome_arquivo like "'.substr(strtolower($nmarquivos[$indice]),0,5).'"','Aditivosplanofirutavfr.tamanho ='.$tamanhos[$indice]), 'group'=>array('Aditivosplanofirutavfr.nome_arquivo, Aditivosplanofirutavfr.tamanho'), 'order'=>array('Aditivosplanofirutavfr.tamanho desc')));
             $conteudo = file_get_contents($vetorarquivo[$indice]);
             if(!empty($verificaexistencia)){
                $conteudo = substr($conteudo, $verificaexistencia[0]['Aditivosplanofirutavfr']['tamanho']);
             }
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   if(count($vetor2)==6){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))&&((is_numeric($vetor2[5])))){
                           $dados['Aditivosplanofirutavfr']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanofirutavfr']['fir'] = $vetor2[3];
                           $dados['Aditivosplanofirutavfr']['uta'] = $vetor2[4];
                           $dados['Aditivosplanofirutavfr']['vfr'] = $vetor2[5];
                           $dados['Aditivosplanofirutavfr']['nome_arquivo'] = substr(strtolower($nmarquivos[$indice]),0,5);
                           $dados['Aditivosplanofirutavfr']['tamanho'] = $tamanhos[$indice];
                           $dados['Aditivosplanofirutavfr']['created'] = date('Y-m-d h:i:s');
                           $this->Aditivosplano->Aditivosplanofirutavfr->create();
                           if($this->Aditivosplano->Aditivosplanofirutavfr->save($dados)){
                              
                           }
                      }
                   }
                }             
              //tipo FIR UTA VFR
          }   
          
      }

exit();    
    
 
            
                
            
}


}
?>