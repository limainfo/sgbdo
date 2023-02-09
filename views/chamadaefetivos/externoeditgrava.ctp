<?php 
			if ($ok) {
				echo '<p class="message" id="mensagens"><b>Os dados foram gravados.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');</script>';
			} else {
				echo '<p class="message" id="mensagens"><b>Os dados não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
			}

?>


<table cellpadding="0" cellspacing="0">
<tr style="vertical-align:middle;"><th colspan="20" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;"><center>EFETIVO DAS CHAMADAS&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center>
</th></tr>
<tr><th>Divisão</th><th>Nome Chamada</th><th>Militar</th><th>Ações</th></tr>
	<?php 
$i=0;
		$dados = $this->requestAction('chamadaefetivos/externolista');
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Chamadaefetivo']['divisao']}</td>";
				echo "<td>{$dado['Chamadaefetivo']['nome_chamada']}</td>";
				echo "<td>{$dado['Chamadaefetivo']['nome_militar']}</td>";
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Chamadaefetivo']['id']),array('escape'=>false, 'update'=>'formularios','method'=>'post', 'with'=>'\'data[id]='.$dado['Chamadaefetivo']['id'].'&value=help\'' ), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Chamada']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Chamadaefetivo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
				echo "<td></td></tr>";
			
		}
				
?>
</table>
<?php  
	echo $ajax->divEnd('listagem');
	


?>

<script type="text/javascript">
HideContent('carregando');
HideContent('detalhes');
function consultanome() {
	var dados = Form.serialize($('ChamadaefetivoAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>afastamentos/externoconsultanomes/1', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText;
		    	$('ChamadaefetivoMilitarId').innerHTML = unescape(resultado);
						}
				})
        
    
    return false;
}

function atribui(){
	$('ChamadaefetivoNomeMilitar').value = $('ChamadaefetivoMilitarId').options[$('ChamadaefetivoMilitarId').options.selectedIndex].text; 
}

function registra() {
	$('ChamadaefetivoAddForm').submit();
}



</script>