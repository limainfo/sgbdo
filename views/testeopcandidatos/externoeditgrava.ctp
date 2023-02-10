<?php 
$centralizado = 'style="z-index: 2; position: fixed; float:center; height:100px;margin: auto;  top: 50%;  left: 50%; margin: -20px  0px;  padding: 0px;border-color:#000;border: 1px 1px 1px 1px solid #000;float:center;"';
			if ($ok) {
				echo '<p class="message" id="mensagens" '.$centralizado.'><b>Os dados foram gravados.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');</script>';
			} else {
				echo '<p class="message" id="mensagens" '.$centralizado.'><b>Os dados não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
			}

?>
<table cellpadding="0" cellspacing="0">
<tr style="vertical-align:middle;"><th colspan="20" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;"><center>LISTAGEM DOS CANDIDATOS PARA AS PROVAS AGENDADAS PARA TESTE OPERACIONAL&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	//echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'width'=> '10 px', 'height'=> '10 px', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center>
</th></tr>
<tr><th>ProvaAgendada</th><th>Unidade</th><th>Setor</th><th>Candidato</th><th>Nota01</th><th>Nota02</th><th>Nota03</th><th>Nota04</th><th>Status01</th><th>Status02</th><th>Status03</th><th>Status04</th><th>Obs01</th><th>Obs02</th><th>Obs03</th><th>Obs04</th><th>Ações</th></tr>
	<?php 
$i=0;
		$dados = $this->requestAction('testeopcandidatos/externolista');
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
                if(!empty($dado['Testeopcandidato']['status04'])){
                       if(!empty($dado['Testeopcandidato']['obs04'])){
                            $class = ' style="background-color:#00cdcd;"';
                       }else{
                            $class = ' style="background-color:#ffffff;"';
                       }
                       if($dado['Testeopcandidato']['status04']=='APROVADO'){
                            $class = ' style="background-color:#32cd32;"';
                         }
                      if($dado['Testeopcandidato']['status04']=='REPROVADO'){
                            $class = ' style="background-color:#ff0000;"';
                         }
                      if($dado['Testeopcandidato']['status04']=='AUSENTE'){
                            $class = ' style="background-color:#ffd700;"';
                         }
                }else{
                           if(!empty($dado['Testeopcandidato']['status03'])){
                                   if(!empty($dado['Testeopcandidato']['obs03'])){
                                        $class = ' style="background-color:#00cdcd;"';
                                   }else{
                                        $class = ' style="background-color:#ffffff;"';
                                   }
                                   if($dado['Testeopcandidato']['status03']=='APROVADO'){
                                        $class = ' style="background-color:#32cd32;"';
                                     }
                                  if($dado['Testeopcandidato']['status03']=='REPROVADO'){
                                        $class = ' style="background-color:#ff0000;"';
                                     }
                                  if($dado['Testeopcandidato']['status03']=='AUSENTE'){
                                        $class = ' style="background-color:#ffd700;"';
                                     }
                            }else{
                               
                                    if(!empty($dado['Testeopcandidato']['status02'])){
                                            if(!empty($dado['Testeopcandidato']['obs02'])){
                                                 $class = ' style="background-color:#00cdcd;"';
                                            }else{
                                                 $class = ' style="background-color:#ffffff;"';
                                            }
                                            if($dado['Testeopcandidato']['status02']=='APROVADO'){
                                                 $class = ' style="background-color:#32cd32;"';
                                              }
                                           if($dado['Testeopcandidato']['status02']=='REPROVADO'){
                                                 $class = ' style="background-color:#ff0000;"';
                                              }
                                           if($dado['Testeopcandidato']['status02']=='AUSENTE'){
                                                 $class = ' style="background-color:#ffd700;"';
                                              }
                               }else{
                               
                                    if(!empty($dado['Testeopcandidato']['status01'])){
                                            if(!empty($dado['Testeopcandidato']['obs01'])){
                                                 $class = ' style="background-color:#00cdcd;"';
                                            }else{
                                                 $class = ' style="background-color:#ffffff;"';
                                            }
                                            if($dado['Testeopcandidato']['status01']=='APROVADO'){
                                                 $class = ' style="background-color:#32cd32;"';
                                              }
                                           if($dado['Testeopcandidato']['status01']=='REPROVADO'){
                                                 $class = ' style="background-color:#ff0000;"';
                                              }
                                           if($dado['Testeopcandidato']['status01']=='AUSENTE'){
                                                 $class = ' style="background-color:#ffd700;"';
                                              }
                            }
                   
                }
                            }}
                            
                                    if((empty($dado['Testeopcandidato']['status01']))&&(empty($dado['Testeopcandidato']['status02']))&&(empty($dado['Testeopcandidato']['status03']))&&(empty($dado['Testeopcandidato']['status04']))){
                                            if(!empty($dado['Testeopcandidato']['obs01'])){
                                                 $class = ' style="background-color:#00cdcd;"';
                                            }else{
                                                 $class = ' style="background-color:#ffffff;"';
                                            }
                                    }
                            
                            				
                echo "<tr {$class}><td {$class}>{$dado['Testeopprovasagendada']['ano']}-{$dado['Testeopprovasagendada']['divisao']}-{$dado['Testeopprovasagendada']['subdivisao']}=>{$dado['Testeopprova']['nm_prova']}</td>";
                echo "<td {$class}>{$dado['Unidade']['sigla_unidade']}</td>";
                echo "<td {$class}>{$dado['Setor']['sigla_setor']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['nm_candidato']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['nota01']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['nota02']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['nota03']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['nota04']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['status01']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['status02']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['status03']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['status04']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['obs01']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['obs02']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['obs03']}</td>";
                echo "<td {$class}>{$dado['Testeopcandidato']['obs04']}</td>";
                echo "<td {$class}>";
                //echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
                echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Testeopcandidato']['id']),array('escape'=>false, 'update'=>'formularios','method'=>'post', 'with'=>'\'data[id]='.$dado['Testeopcandidato']['id'].'&value=help\'' ), null,false);
                echo '&nbsp;&nbsp;&nbsp;';
                echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Testeopcandidato']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Testeopcandidato']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
                echo "<td {$class}></td></tr>";
    			
		}
				
?>
</table>

