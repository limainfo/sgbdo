
<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para edição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Testeopcandidato', array('action'=>'edit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Cadastrar Candidatos');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
$motivos['']='';
$motivos['APROVADO']='APROVADO';
$motivos['AUSENTE']='AUSENTE';
$motivos['REPROVADO']='REPROVADO';

//echo $form->input('unidade_id',array('class'=>'formulario','onChange'=>'javascript:listasetores();'));

$altura = 'height:80px;';
		echo $form->input('id');
		echo $form->input('testeopprovasagendada_id',array('class'=>'formulario','label'=>'Ano-Unidade-Setor-Prova'));
		echo $form->input('unidade_id', array('onChange'=>'javascript:listasetores();','type'=>'select','options'=>$unidades,'class'=>'formulario','style'=>'vertical-align:top;'), false);
		echo $form->input('setor_id', array('type'=>'select','options'=>$setors,'class'=>'formulario','style'=>'vertical-align:top;'), false);
		echo $form->input('especialidade_id',array('class'=>'formulario', 'onChange'=>'javascript:listamilitares();','default'=>$this->data['Testeopprovasagendada']['especialidade_id']));
		echo $form->input('militar_id',array('class'=>'formulario', 'onChange'=>'javascript:$(\'TesteopcandidatoNmCandidato\').value=$(\'TesteopcandidatoMilitarId\').options[$(\'TesteopcandidatoMilitarId\').selectedIndex].text;'));
		echo $form->input('nm_candidato',array('class'=>'formulario','size'=>'50', 'readonly'=>'readonly'));
		echo $form->input('nota01',array('class'=>'formulario'));
		echo $form->input('nota02',array('class'=>'formulario'));
		echo $form->input('nota03',array('class'=>'formulario'));
		echo $form->input('nota04',array('class'=>'formulario'));
		echo $form->input('status01',array('class'=>'formulario','type' => 'select', 'options' => $motivos));
		echo $form->input('status02',array('class'=>'formulario','type' => 'select', 'options' => $motivos));
		echo $form->input('status03',array('class'=>'formulario','type' => 'select', 'options' => $motivos));
		echo $form->input('status04',array('class'=>'formulario','type' => 'select', 'options' => $motivos));
		echo $form->input('obs01',array('class'=>'formulario','rows'=>'3', 'style' => $altura));
		echo $form->input('obs02',array('class'=>'formulario','rows'=>'3', 'style' => $altura));
		echo $form->input('obs03',array('class'=>'formulario','rows'=>'3', 'style' => $altura));
		echo $form->input('obs04',array('class'=>'formulario','rows'=>'3', 'style' => $altura));
		
		echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'Testeopcandidatos', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';



?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('formularios');

//$this->data['Testeopprovasagendada']['especialidade_id']
  	listamilitares();
                                     
Event.observe('TesteopcandidatoTesteopprovasagendadaId', 'change', function(event) { 
	new Ajax.Request('<?php echo $this->webroot;?>testeopcandidatos/externoespecialidadeid/', {
				method: 'post',
				postBody: Form.serialize($('TesteopcandidatoEditForm')),
				onSuccess: function(transport) {
	
				var resultado = transport.responseText.evalJSON(true);
				
				 
				var c = $('TesteopcandidatoEspecialidadeId'), i=0;
				for (; i<c.options.length; i++){
				if (c.options[i].value == resultado.especialidadeid){
				c.options[i].selected = true;}}
				listamilitares();
			}
					})
}, false);

</script>
		