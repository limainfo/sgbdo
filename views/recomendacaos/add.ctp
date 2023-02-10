<div class="recomendacaos form">
<?php echo $form->create('Recomendacao');?>
	<fieldset>
 		<legend><?php __('Cadastrar Recomendacão de Segurança');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
	
$select1 = '<select id="documentocomplete" name="documentocomplete" class="formulario">';
foreach($documento as $dado){
	$select1 .= '<option value="'.$dado['recomendacaos']['documento'].'" selected>'.$dado['recomendacaos']['documento'].'</option>';
}
$select1 .= '</select>';

echo '<table><tr><td>'.$form->input('documento',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('documentocomplete', 'change', function(event) { $('RecomendacaoDocumento').value = $('documentocomplete').options[$('documentocomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;

		echo $datePicker->picker('data',array('class'=>'formulario'));
$select1 = '<select id="localidadecomplete" name="localidadecomplete" class="formulario">';
foreach($localidade as $dado){
	$select1 .= '<option value="'.$dado['recomendacaos']['localidade'].'" selected>'.$dado['recomendacaos']['localidade'].'</option>';
}
$select1 .= '</select>';

echo '<table><tr><td>'.$form->input('localidade',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('localidadecomplete', 'change', function(event) { $('RecomendacaoLocalidade').value = $('localidadecomplete').options[$('localidadecomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;

$select1 = '<select id="setorcomplete" name="setorcomplete" class="formulario">';
foreach($setor as $dado){
	$select1 .= '<option value="'.$dado['recomendacaos']['setor'].'" selected>'.$dado['recomendacaos']['setor'].'</option>';
}
$select1 .= '</select>';

echo '<table><tr><td>'.$form->input('setor',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('setorcomplete', 'change', function(event) { $('RecomendacaoSetor').value = $('setorcomplete').options[$('setorcomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;
echo $form->input('perigo_identificado',array('class'=>'formulario'));
		echo $form->input('descricao_perigo',array('class'=>'formulario'));
		echo $datePicker->picker('data_recomendacao',array('class'=>'formulario'));
		echo $form->input('numero_recomendacao',array('class'=>'formulario'));
		echo $form->input('descricao_recomendacao',array('class'=>'formulario'));
		echo $form->input('prazo_sipacea',array('class'=>'formulario'));
		echo $datePicker->picker('prazo_do',array('class'=>'formulario'));
		echo $form->input('providencia',array('class'=>'formulario'));
		//echo $form->input('parecer_oaple',array('class'=>'formulario'));
		echo $form->input('proxima_acao',array('class'=>'formulario'));
		$select1 = '<select id="statuscomplete" name="statuscomplete" class="formulario">';
foreach($status as $dado){
	$select1 .= '<option value="'.$dado['recomendacaos']['status'].'" selected>'.$dado['recomendacaos']['status'].'</option>';
}
$select1 .= '</select>';

echo '<table><tr><td>'.$form->input('status',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('statuscomplete', 'change', function(event) { $('RecomendacaoStatus').value = $('statuscomplete').options[$('statuscomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;
		echo $form->input('registro_cumprimento',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
