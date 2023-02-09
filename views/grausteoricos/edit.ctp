<div class="atividades form">
<?php echo $form->create('Grausteorico');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Atividade');?>&nbsp;&nbsp;&nbsp;
 					<?php
		echo $yahooUi->generateScriptForSimpleDialog('del'.$this->data['Atividade']['id'], array('body'=>'Tem certeza que deseja excluir # '.$this->data['Atividade']['desc_atividade'].' ?'));
		echo $yahooUi->imgForSimpleDialog('del'.$this->data['Atividade']['id'],'lixo.gif',array('function'=>'delete','id'=>$this->data['Atividade']['id'])); 
		?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
		echo $form->input('id');
	?>
<table width="749" border="0" cellpadding="0" cellspacing="0"
	class="content">		
		<tr>
		<td widht="20%">
		<div class="input text required"><label for="AtividadeMilitarId">Militar:</label><?php echo $militars[0][0]['Militar.nm_completo']; ?></div>		
		<?php echo $form->hidden('militar_id',array('class'=>'formulario')); ?>
		</td>
		<td widht="80%">
		<?php	echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar novo Militar','style'=>'float:left;text-padding:0px;text-align:left;')), array('controller'=>'militars','action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
		?> 
		</td>
		</tr>
</table>		
	<?php
$select1 = '<select id="setorcomplete" name="setorcomplete" class="formulario">';
foreach($setor as $dado){
	$select1 .= '<option value="'.$dado['setors']['sigla_setor'].'" selected>'.$dado['setors']['sigla_setor'].'</option>';
}
$select1 .= '</select>';

echo '<table><tr><td>'.$form->input('orgao',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('setorcomplete', 'change', function(event) { $('AtividadeOrgao').value = $('setorcomplete').options[$('setorcomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;
		echo $form->input('desc_atividade',array('class'=>'formulario'));
		echo $datePicker->picker('dt_inicio',array('class'=>'formulario'));
		echo $datePicker->picker('dt_termino',array('class'=>'formulario'));
		echo $form->input('periodo',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
