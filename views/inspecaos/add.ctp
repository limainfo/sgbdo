<div class="inspecaos form"><?php echo $form->create('Inspecao');?>
<fieldset><legend><?php __('Cadastrar Inspeção');?>	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend> <?php

$select1 = '<select id="origemcomplete" name="origemcomplete" class="formulario">';
foreach($origem as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['organizacao'].'">'.$dado['inspecaos']['organizacao'].'</option>';
}
$select1 .= '<option value="" selected="selected"></option></select>';
 
 
echo '<table><tr><td>'.$form->input('organizacao',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('origemcomplete', 'change', function(event) { $('InspecaoOrganizacao').value = $('origemcomplete').options[$('origemcomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;

echo $form->input('numero',array('class'=>'formulario'));

$select1 = '<select id="tipocomplete" name="tipocomplete" class="formulario">';
foreach($tipo as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['tipo'].'">'.$dado['inspecaos']['tipo'].'</option>';
}
$select1 .= '<option value="" selected="selected"></option></select>';

echo '<table><tr><td>'.$form->input('tipo',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('tipocomplete', 'change', function(event) { $('InspecaoTipo').value = $('tipocomplete').options[$('tipocomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;
	
//echo $form->input('numero',array('class'=>'formulario'));
echo $datePicker->picker('data',array('class'=>'formulario'));



$select1 = '<select id="orgaocomplete" name="orgaocomplete" class="formulario">';
foreach($organizacao as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['orgao'].'">'.$dado['inspecaos']['orgao'].'</option>';
}
$select1 .= '<option value="" selected="selected"></option></select>';

echo '<table><tr><td>'.$form->input('orgao',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('orgaocomplete', 'change', function(event) { $('InspecaoOrgao').value = $('orgaocomplete').options[$('orgaocomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;


echo $form->input('item',array('class'=>'formulario'));
echo $form->input('descricao',array('class'=>'formulario'));
echo $form->input('meta',array('class'=>'formulario'));
echo $form->input('status_meta',array('class'=>'formulario'));
echo $form->input('controle_oaple',array('class'=>'formulario'));
echo $form->input('gestor',array('class'=>'formulario'));
echo $form->input('acao_recomendada',array('class'=>'formulario'));
echo $form->input('obs_chf_d_o',array('class'=>'formulario'));
echo $form->input('plano_acao_gestor',array('class'=>'formulario'));
echo $form->input('acoes_executadas',array('class'=>'formulario'));
echo $form->input('prazo',array('class'=>'formulario'));
echo $form->input('status',array('class'=>'formulario'));
echo $form->input('proxima_acao',array('class'=>'formulario'));
echo $form->input('prazo_proxima_acao',array('class'=>'formulario'));
echo $form->hidden('temp_plano',array('class'=>'formulario'));
echo $form->hidden('temp_acoes',array('class'=>'formulario'));



?></fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?></div>
