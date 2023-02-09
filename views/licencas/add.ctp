<center>
<?php 
include $caminhoAditivos;
?>
<div class="licencas form">
<?php echo $this->Form->create('Licenca');?>
	<fieldset>
 		<legend><?php __('Cadastrar Licenca'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('unidade_id',array('onChange'=>'javascript:listamilitares();','type'=>'select','class'=>'formulario'));
		echo $this->Form->input('militar_id',array('class'=>'formulario'));
		echo $this->Form->input('documento_comprobatorio',array('class'=>'formulario', 'type'=>'select','options'=>$tbl_documentos));
		echo $this->Form->input('numero_documento',array('class'=>'formulario'));
		echo $this->Form->input('tipo_licenca',array('class'=>'formulario','options'=>$tipos_licencas));
		echo $this->Form->input('ata_id',array('class'=>'formulario'));
		echo $this->Form->input('boletiminterno_id',array('class'=>'formulario'));
		echo $this->Form->input('ticket',array('class'=>'formulario'));
		echo $this->Form->input('carimbo_id',array('class'=>'formulario'));
		//	echo $this->Form->input('numero_licenca',array('class'=>'formulario'));
		?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<script>

function listamilitares(){
	new Ajax.Updater('LicencaMilitarId','externomilitares', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('LicencaUnidadeId'), requestHeaders:['X-Update', 'LicencaMilitarId']})
	//new Ajax.Updater('LicencaAtaId','externoatas', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('LicencaUnidadeId'), requestHeaders:['X-Update', 'LicencaAtaId']})
	//new Ajax.Updater('LicencaBoletiminternoId','externoboletins', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('LicencaUnidadeId'), requestHeaders:['X-Update', 'Boletiminterno']})
}	

</script>
</center>