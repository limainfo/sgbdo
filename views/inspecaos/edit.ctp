<?php 
//print_r($u);
if($u[0]['Usuario']['privilegio_id']==12){
	$leitura = array('readonly'=>'readonly');
}else{
	$leitura = array();
}
?>
<div class="inspecaos form">
<?php echo $form->create('Inspecao');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Inspecao');?>	&nbsp;&nbsp;&nbsp;
 					<?php
		echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Inspecao']['numero']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Inspecao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
		?>
	&nbsp;&nbsp;&nbsp;
		<?php //echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
		echo $form->input('id');
$select1 = '<select id="origemcomplete" name="origemcomplete" class="formulario">';
if(empty($leitura)){
foreach($origem as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['organizacao'].'">'.$dado['inspecaos']['organizacao'].'</option>';
}
}
$select1 .= '<option value="'.$this->data['Inspecao']['organizacao'].'" selected="selected">'.$this->data['Inspecao']['organizacao'].'</option></select>';
 
 
echo '<table><tr><td>'.$form->input('organizacao',array('class'=>'formulario',$leitura)).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('origemcomplete', 'change', function(event) { $('InspecaoOrigem').value = $('origemcomplete').options[$('origemcomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;

echo $form->input('numero',array('class'=>'formulario',$leitura));

$select1 = '<select id="tipocomplete" name="tipocomplete" class="formulario">';
if(empty($leitura)){

foreach($tipo as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['tipo'].'" >'.$dado['inspecaos']['tipo'].'</option>';
}
}
$select1 .= '<option value="'.$this->data['Inspecao']['tipo'].'" selected="selected">'.$this->data['Inspecao']['tipo'].'</option></select>';

echo '<table><tr><td>'.$form->input('tipo',array('class'=>'formulario',$leitura)).'</td><td>'.$select1.'</td></tr></table>';

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('tipocomplete', 'change', function(event) { $('InspecaoTipo').value = $('tipocomplete').options[$('tipocomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;

echo $datePicker->picker('data',array('class'=>'formulario',$leitura));


$select1 = '<select id="orgaocomplete" name="orgaocomplete" class="formulario">';

if(empty($leitura)){
foreach($organizacao as $dado){
	$select1 .= '<option value="'.$dado['inspecaos']['orgao'].'">'.$dado['inspecaos']['orgao'].'</option>';
}
}
$select1 .= '<option value="'.$this->data['Inspecao']['orgao'].'" selected="selected">'.$this->data['Inspecao']['orgao'].'</option></select>';

echo '<table><tr><td>'.$form->input('orgao',array('class'=>'formulario',$leitura)).'</td><td>'.$select1.'</td></tr></table>';

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('orgaocomplete', 'change', function(event) { $('InspecaoOrgao').value = $('orgaocomplete').options[$('orgaocomplete').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;


if(empty($leitura)){
echo $form->input('item',array('class'=>'formulario'));
echo $form->input('descricao',array('class'=>'formulario'));
echo $form->input('meta',array('class'=>'formulario'));
echo $form->input('status_meta',array('class'=>'formulario'));
echo $form->input('controle_oaple',array('class'=>'formulario'));
echo $form->input('gestor',array('class'=>'formulario'));
}else{
echo $form->input('item',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('descricao',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('meta',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('status_meta',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('controle_oaple',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('gestor',array('class'=>'formulario','readonly'=>'readonly'));
	
}
echo $form->input('acao_recomendada',array('class'=>'formulario'));
echo $form->input('plano_acao_gestor',array('class'=>'formulario'));
echo $form->input('acoes_executadas',array('class'=>'formulario'));

if(empty($leitura)){
echo $form->input('obs_chf_d_o',array('class'=>'formulario'));
echo $form->input('prazo',array('class'=>'formulario'));
echo $form->input('status',array('class'=>'formulario'));
}else{
echo $form->input('obs_chf_d_o',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('prazo',array('class'=>'formulario','readonly'=>'readonly'));
echo $form->input('status',array('class'=>'formulario','readonly'=>'readonly'));
	
}
echo $form->hidden('temp_plano',array('class'=>'formulario'));
echo $form->hidden('temp_acoes',array('class'=>'formulario'));
echo "<input type=\"hidden\" id=\"consulta\" value=\"".$consulta."\" name=\"consulta\"/>";
?></fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?></div>
		