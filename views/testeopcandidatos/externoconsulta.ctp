<table cellpadding="0" cellspacing="0" border="1">
<tr style="vertical-align:middle;"><th colspan="20" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;">
<!-- <center>ATRIBUIÇÃO/EXCLUSÃO DE CANDIDATOS PARA AS PROVAS AGENDADAS DO TESTE OPERACIONAL&nbsp;&nbsp;&nbsp;&nbsp;  -->
<center><?php echo count($dados).' militar(es) com a especialidade informada.'; ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 	
echo '<center>'.$ajax->submit('Executar seleções', array('url'=> array('controller'=>'Testeopcandidatos', 'action'=>'externoconsulta'), 'update' => 'listagem', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
?>

<?php 
	//echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center>
</th></tr>

<tr>
<th>Unidade</th><th>Setor</th><th>Candidato</th>
<th>
Atribuir
</th>
<th>
Excluir
</th>
<tr>
<th></th><th></th><th></th>
<th>
<?php 	
?>
<a   style="padding: 1px; font-size: 0.8em;"><img border="0" id="todosinclui" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></th>
</th>
<th>
<?php 	
?>
<a   style="padding: 1px; font-size: 0.8em;"><img border="0" id="todosexclui" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></th>
</th>
</tr>
	<?php 
$i=0;
		//$dados = $this->requestAction('testeopcandidatos/externolista');
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}>";
				echo "<td>{$dado['Unidade']['sigla_unidade']}</td>";
				echo "<td>{$dado['Setor']['sigla_setor']}</td>";
				echo "<td>{$dado['Posto']['sigla_posto']} {$dado['Militar']['nm_completo']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['ano']}-{$dado['Testeopprovasagendada']['divisao']}-{$dado['Testeopprovasagendada']['subdivisao']}=>{$dado['Testeopprova']['nm_prova']}";
				echo '<input type="checkbox" name="data[Militar][inclusao][]" id="idinclui'.$dado['Militar']['id'].'" value="'.$dado['Militar']['id'].'">';
				echo "</td>";
				
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo '<input type="checkbox" name="data[Militar][exclusao][]" id="idexclui'.$dado['Militar']['id'].'" value="'.$dado['Testeopcandidato']['id'].'">';
				echo "</td></tr>";
			
		}
				
?>
</table>
				<script type="text/javascript">
	

				Event.observe('todosinclui', 'click', function(event) {
					var formulario = $('TesteopcandidatoExternoatribuiForm');
					var x =formulario.getInputs('checkbox');
					for(i=0;i<x.size();i++){
						nome = x[i].id; 
						if(nome.startsWith('idinclui')){
						   if(x[i].checked){
						    x[i].checked = false;
						    }else{
						    x[i].checked = true;
						    }
						}
					}
					
				     });
			     
				Event.observe('todosexclui', 'click', function(event) {
					var formulario = $('TesteopcandidatoExternoatribuiForm');
					var x =formulario.getInputs('checkbox');
					for(i=0;i<x.size();i++){
						nome = x[i].id; 
						if(nome.startsWith('idexclui')){
						   if(x[i].checked){
						    x[i].checked = false;
						    }else{
						    x[i].checked = true;
						    }
						}
					}
					
				     });
     //, false   		
</script>
