<?php
error_reporting(E_ALL);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class bdMysql {
    

    public $ptrconexao = null;
    public $ptrbanco = null;
    public $db = 'SGBDO';
    public $host = '10.112.24.12';
    public $usuario = 'sgbdo';
    public $senha = 'sgbdo';
    public $resultado = null;

    public function conecta($host, $usuario, $senha) {
        $this->host=$host;
        $this->usuario=$usuario;
        $this->senha=$senha;
        $this->ptrconexao = mysql_connect($this->host, $this->usuario, $this->senha);
        $this->ptrbanco=mysql_select_db('SGBDO',$this->ptrconexao);
        if(!$this->ptrconexao){
            echo 'CONEXAO=>'.mysql_error();
        }
        if(!$this->ptrbanco){
            echo 'BD=>'.mysql_error();
        }
    }
    public function consulta($sql){
        $this->resultado = mysql_query($sql);
        return $this->resultado;
        
    }
    
}
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $diretorio = $dir;
   
   $banco = new bdMysql();
   $banco->conecta('10.112.24.12','sgbdo', 'sgbdo');
   $dados=$banco->consulta('select * from militars ');

 
   
   
function lista($centro, $extensao, $classebanco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $classebanco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
                    $classebanco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                }
            }
        }
        closedir($handle);
        return $vetorarquivo;
    }    
}



function processaPlanoTrecho($centro, $extensao, $banco){
   // $vetorarquivo=lista($centro,$extensao, $banco);
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
    
    $contagem = 0;
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
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
                           $dados['Aditivosplanotrecho']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanotrecho']['tamanho'] = $tamanho;
                           $dados['Aditivosplanotrecho']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanotrecho']['centro'] = $centro;
                          // $this->Aditivosplano->Aditivosplanotrecho->create();
                           //if($this->Aditivosplano->Aditivosplanotrecho->save($dados)){             }
$insere=<<<INSERE
insert into aditivosplanotrechos (data, espaco, regra,aerovia, trecho, qtd, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanotrecho']['data']}','{$dados['Aditivosplanotrecho']['espaco']}','{$dados['Aditivosplanotrecho']['regra']}',
'{$dados['Aditivosplanotrecho']['aerovia']}','{$dados['Aditivosplanotrecho']['trecho']}',{$dados['Aditivosplanotrecho']['qtd']},
'{$dados['Aditivosplanotrecho']['nome_arquivo']}',{$dados['Aditivosplanotrecho']['tamanho']},'{$dados['Aditivosplanotrecho']['created']}',
'{$dados['Aditivosplanotrecho']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoTrecho('MU','.rel1', $banco);
processaPlanoTrecho('PH','.rel1', $banco);
processaPlanoTrecho('BL','.rel1', $banco);

function processaPlanoDia($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanodia']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanodia']['ativados'] = $vetor2[3];
                           $dados['Aditivosplanodia']['naoativados'] = $vetor2[4];
                           $dados['Aditivosplanodia']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanodia']['tamanho'] = $tamanho;
                           $dados['Aditivosplanodia']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanodia']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanodias (data, ativados, naoativados,nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanodia']['data']}',{$dados['Aditivosplanodia']['ativados']},{$dados['Aditivosplanodia']['naoativados']},
'{$dados['Aditivosplanodia']['nome_arquivo']}',{$dados['Aditivosplanodia']['tamanho']},'{$dados['Aditivosplanodia']['created']}',
'{$dados['Aditivosplanodia']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoDia('MU','.rel2', $banco);
processaPlanoDia('PH','.rel2', $banco);
processaPlanoDia('BL','.rel2', $banco);

function processaPlanoHora($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanohora']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanohora']['hora'] = $vetor2[3];
                           $dados['Aditivosplanohora']['qtd'] = $vetor2[4];
                           $dados['Aditivosplanohora']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanohora']['tamanho'] = $tamanho;
                           $dados['Aditivosplanohora']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanohora']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanohoras (data, hora, qtd, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanohora']['data']}',{$dados['Aditivosplanohora']['hora']},{$dados['Aditivosplanohora']['qtd']},
'{$dados['Aditivosplanohora']['nome_arquivo']}',{$dados['Aditivosplanohora']['tamanho']},'{$dados['Aditivosplanohora']['created']}',
'{$dados['Aditivosplanohora']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoHora('MU','.rel3', $banco);
processaPlanoHora('PH','.rel3', $banco);
processaPlanoHora('BL','.rel3', $banco);

function processaPlanoSetor($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==5){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_string($vetor2[3])))&&((is_numeric($vetor2[4])))){
                           $dados['Aditivosplanosetor']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanosetor']['setor'] = $vetor2[3].'';
                           $dados['Aditivosplanosetor']['qtd'] = $vetor2[4];
                           $dados['Aditivosplanosetor']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanosetor']['tamanho'] = $tamanho;
                           $dados['Aditivosplanosetor']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanosetor']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanosetors (data, setor, qtd, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanosetor']['data']}','{$dados['Aditivosplanosetor']['setor']}',{$dados['Aditivosplanosetor']['qtd']},
'{$dados['Aditivosplanosetor']['nome_arquivo']}',{$dados['Aditivosplanosetor']['tamanho']},'{$dados['Aditivosplanosetor']['created']}',
'{$dados['Aditivosplanosetor']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoSetor('MU','.rel4', $banco);
processaPlanoSetor('PH','.rel4', $banco);
processaPlanoSetor('BL','.rel4', $banco);

function processaPlanoFIRUTAVFR($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==6){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))&&((is_numeric($vetor2[5])))){
                           $dados['Aditivosplanofirutavfr']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanofirutavfr']['fir'] = $vetor2[3];
                           $dados['Aditivosplanofirutavfr']['uta'] = $vetor2[4];
                           $dados['Aditivosplanofirutavfr']['vfr'] = $vetor2[5];
                           $dados['Aditivosplanofirutavfr']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanofirutavfr']['tamanho'] = $tamanho;
                           $dados['Aditivosplanofirutavfr']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanofirutavfr']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanofirutavfrs (data, fir, uta, vfr nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanofirutavfr']['data']}','{$dados['Aditivosplanofirutavfr']['fir']}','{$dados['Aditivosplanofirutavfr']['uta']}','{$dados['Aditivosplanofirutavfr']['vfr']}',
'{$dados['Aditivosplanofirutavfr']['nome_arquivo']}',{$dados['Aditivosplanofirutavfr']['tamanho']},'{$dados['Aditivosplanofirutavfr']['created']}',
'{$dados['Aditivosplanofirutavfr']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoFIRUTAVFR('MU','.rel5', $banco);
processaPlanoFIRUTAVFR('PH','.rel5', $banco);
processaPlanoFIRUTAVFR('BL','.rel5', $banco);


function processaPlanoDiaComplemento($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==7){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_numeric($vetor2[3])))&&((is_numeric($vetor2[4])))&&((is_numeric($vetor2[5])))&&((is_numeric($vetor2[6])))){
                           $dados['Aditivosplanodiacomplemento']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanodiacomplemento']['ativados'] = $vetor2[3];
                           $dados['Aditivosplanodiacomplemento']['naoativados'] = $vetor2[4];
                           $dados['Aditivosplanodiacomplemento']['acomodados'] = $vetor2[5];
                           $dados['Aditivosplanodiacomplemento']['especial'] = $vetor2[6];
                           $dados['Aditivosplanodiacomplemento']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanodiacomplemento']['tamanho'] = $tamanho;
                           $dados['Aditivosplanodiacomplemento']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanodiacomplemento']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanodiacomplementos (data, ativados, naoativados,acomodados, especial, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanodiacomplemento']['data']}',{$dados['Aditivosplanodiacomplemento']['ativados']},{$dados['Aditivosplanodiacomplemento']['naoativados']},{$dados['Aditivosplanodiacomplemento']['acomodados']},{$dados['Aditivosplanodiacomplemento']['especial']},
'{$dados['Aditivosplanodiacomplemento']['nome_arquivo']}',{$dados['Aditivosplanodiacomplemento']['tamanho']},'{$dados['Aditivosplanodiacomplemento']['created']}',
'{$dados['Aditivosplanodiacomplemento']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaPlanoDiaComplemento('MU','.rel6', $banco);
processaPlanoDiaComplemento('PH','.rel6', $banco);
processaPlanoDiaComplemento('BL','.rel6', $banco);

function processaAtm($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);
                foreach($vetor as $linha){
                   $vetor2 = explode("\t", $linha);
                   
                           
                   if(count($vetor2)==7){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_string($vetor2[3])))&&((is_string($vetor2[4])))&&((is_numeric($vetor2[5])))&&((is_numeric($vetor2[6])))){
                           $dados['Aditivosplanoatm']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanoatm']['aerovia'] = $vetor2[3];
                           $dados['Aditivosplanoatm']['trecho'] = $vetor2[4];
                           $dados['Aditivosplanoatm']['entrada'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0].' '.substr($vetor2[5],0,2).':'.substr($vetor2[5],-2);
                           $dados['Aditivosplanoatm']['saida'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0].' '.substr($vetor2[6],0,2).':'.substr($vetor2[6],-2);
                           $dados['Aditivosplanoatm']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanoatm']['tamanho'] = $tamanho;
                           $dados['Aditivosplanoatm']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanoatm']['centro'] = $centro;
                           
$insere=<<<INSERE
insert into aditivosplanoatms (data, aerovia, trecho, entrada, saida, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanoatm']['data']}','{$dados['Aditivosplanoatm']['aerovia']}','{$dados['Aditivosplanoatm']['trecho']}','{$dados['Aditivosplanoatm']['entrada']}', '{$dados['Aditivosplanoatm']['saida']}',
'{$dados['Aditivosplanoatm']['nome_arquivo']}',{$dados['Aditivosplanoatm']['tamanho']},'{$dados['Aditivosplanoatm']['created']}',
'{$dados['Aditivosplanoatm']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
       echo $nmarquivo."\n";
     
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaAtm('MU','.atm', $banco);
processaAtm('PH','.atm', $banco);
processaAtm('BL','.atm', $banco);
//processaAtm('','.atm', $banco);


function processaSet($centro, $extensao, $banco){
   $dir = "/var/www/sgbdo/webroot/estatisticas/";
   $contador=0;
   $vetorarquivo[0]='';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            $compara=$centro.$extensao;
            if(strpos($file,$compara)!==false){
                $nmarquivo=$dir.$file;
                $tamanho=filesize($nmarquivo);
                $resultado = $banco->consulta('select * from arquivosestatisticas where nm_arquivo="'.$nmarquivo.'" and tamanho='.$tamanho);
                $linha=  mysql_fetch_array($resultado);
                if($linha['nm_arquivo']==''){
                    $vetorarquivo[$contador]=$nmarquivo;
                    $contador++;
//----------------------------------------------------
    
             $conteudo = file_get_contents($nmarquivo);
             $tamanho=filesize($nmarquivo);
             $vetor = explode("\n", $conteudo);

                foreach($vetor as $registro){
                   $vetor2 = explode("\t", $registro);
 
                   if((count($vetor2)==14)||(count($vetor2)==16)){
                     if(((is_numeric($vetor2[0])))&&((is_numeric($vetor2[1])))&&((is_numeric($vetor2[2])))&&((is_string($vetor2[3])))&&((is_string($vetor2[4])))&&((is_numeric($vetor2[5])))&&((is_string($vetor2[6])))&&((is_string($vetor2[7])))&&((is_string($vetor2[8])))&&((is_string($vetor2[9])))&&((is_string($vetor2[10])))&&((is_string($vetor2[11])))&&((is_string($vetor2[12])))&&((is_string($vetor2[13]))))                         
                         {
                           $dados['Aditivosplanoset']['data'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0];
                           $dados['Aditivosplanoset']['setor'] = $vetor2[3];
                           $dados['Aditivosplanoset']['entrada'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0].' '.substr($vetor2[4],0,2).':'.substr($vetor2[4],-2);
                           $dados['Aditivosplanoset']['saida'] = $vetor2[2].'-'.$vetor2[1].'-'.$vetor2[0].' '.substr($vetor2[5],0,2).':'.substr($vetor2[5],-2);
                           $dados['Aditivosplanoset']['indic'] = $vetor2[6];
                           $dados['Aditivosplanoset']['adep'] = $vetor2[7];
                           $dados['Aditivosplanoset']['ades'] = $vetor2[8];
                           $dados['Aditivosplanoset']['tipo'] = $vetor2[9];
                           $dados['Aditivosplanoset']['pto_entrada'] = $vetor2[10];
                           $dados['Aditivosplanoset']['pto_saida'] = $vetor2[11];
                           $dados['Aditivosplanoset']['cfl_entrada'] = $vetor2[12];
                           $dados['Aditivosplanoset']['cfl_saida'] = $vetor2[13];
                           $dados['Aditivosplanoset']['aerovia_entrada'] = $vetor2[14];
                           $dados['Aditivosplanoset']['aerovia_saida'] = $vetor2[15];
                           $dados['Aditivosplanoset']['nome_arquivo'] = $nmarquivo;
                           $dados['Aditivosplanoset']['tamanho'] = $tamanho;
                           $dados['Aditivosplanoset']['created'] = date('Y-m-d h:i:s');
                           $dados['Aditivosplanoset']['centro'] = $centro;
                           
$insere=<<<INSERE
insert ignore into aditivosplanosets (data, setor, entrada, saida, indic, adep, ades, tipo, pto_entrada, pto_saida, cfl_entrada, cfl_saida, aerovia_entrada, aerovia_saida, nome_arquivo, tamanho, created, centro) 
values('{$dados['Aditivosplanoset']['data']}',{$dados['Aditivosplanoset']['setor']},'{$dados['Aditivosplanoset']['entrada']}','{$dados['Aditivosplanoset']['saida']}',
'{$dados['Aditivosplanoset']['indic']}','{$dados['Aditivosplanoset']['adep']}', '{$dados['Aditivosplanoset']['ades']}', '{$dados['Aditivosplanoset']['tipo']}',
'{$dados['Aditivosplanoset']['pto_entrada']}', '{$dados['Aditivosplanoset']['pto_saida']}', '{$dados['Aditivosplanoset']['cfl_entrada']}', '{$dados['Aditivosplanoset']['cfl_saida']}',
 '{$dados['Aditivosplanoset']['aerovia_entrada']}', '{$dados['Aditivosplanoset']['aerovia_saida']}',
'{$dados['Aditivosplanoset']['nome_arquivo']}',{$dados['Aditivosplanoset']['tamanho']},'{$dados['Aditivosplanoset']['created']}',
'{$dados['Aditivosplanoset']['centro']}')
INSERE;
                    $banco->consulta($insere);
                      }
                   }
                }             
      echo $nmarquivo."\n";
//----------------------------------------------------
                    $banco->consulta("insert into arquivosestatisticas (nm_arquivo, centro, tamanho, tipo) values('$nmarquivo','$centro','$tamanho', '$extensao')");
                
                      }
            }
        }
        closedir($handle);
    }    

}

processaSet('MU','.set', $banco);
processaSet('PH','.set', $banco);
processaSet('BL','.set', $banco);

?>
