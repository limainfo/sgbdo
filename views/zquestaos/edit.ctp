<div class="zquestaos form">
<?php  $raiz=$this->webroot;
?>
<table>
<tr>
<td>
<form accept-charset="utf-8" action="<?php echo $raiz; ?>zquestaos/edit/<?php echo $idantes;?>" method="post" id="ZquestaoEditForm"><input type="hidden" value="POST" name="_method"><input type="hidden" id="ZquestaoId" value="<?php echo $idantes; ?>" name="data[Zquestao][id]"><input type="submit" value="Anterior"></form>
</td>
<td>
<form accept-charset="utf-8" action="<?php echo $raiz; ?>zquestaos/edit/<?php echo $iddepois;?>" method="post" id="ZquestaoEditForm"><input type="hidden" value="POST" name="_method"><input type="hidden" id="ZquestaoId" value="<?php echo $iddepois; ?>" name="data[Zquestao][id]"><input type="submit" value="Proxima"></form>
</td>
</tr>
</table>

<?php echo $this->Form->create('Zquestao');?>
	<fieldset>
 		<legend><?php __('Modificar Questao'); ?></legend>
	<?php
		echo $this->Form->input('id');
$select1 = '<select id="nome_prova" name="nome_prova" class="formulario">';
//print_r($provas);
foreach($provas as $chave=>$valor){
	$select1 .= '<option value="'.$chave.'">'.$valor."</option>";
}
$select1 .= "<option value=\"\" selected=\"selected\"></option></select>";
 echo "<label >Regulamentos</label>".$select1;
 
//echo '<table><tr><td>'.$form->input('organizacao',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('nome_prova', 'change', function(event) { $('ZquestaoRegulamento').value = $('nome_prova').options[$('nome_prova').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;				
		echo $this->Form->input('regulamento');
		echo $this->Form->input('referencia');
		if(isset($this->data['Zquestao']['zfoto_id'])){
			$img = $this->data['Zquestao']['zfoto_id'];
		    echo '<center>'.$this->Html->image(array('controller'=> 'zquestaos', 'action'=>'externodownload',$img)).'</center>'; //  
		}
		echo $this->Form->input('item');
		echo $this->Form->hidden('zfoto_id');
		echo $this->Form->hidden('tentativas');
		//		echo $this->Form->input('resposta');
		echo '<label>Resposta:</label>'.$this->Form->select('Zquestao.resposta',array(''=>'','A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'),$this->data['Zquestao']['resposta']);
		?>
	</fieldset>
<?php echo $this->Form->end(__('Registrar', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Zquestao.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Zquestao.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Zquestaos', true), array('action' => 'index'));?></li>
	</ul>
</div>