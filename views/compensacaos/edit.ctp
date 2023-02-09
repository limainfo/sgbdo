<div class="habilitacaos form">
<?php echo $form->create('Testeopprova');?>
	<fieldset>
 		<legend><?php __('Cadastrar Provas TesteOp');?>&nbsp;&nbsp;&nbsp;
 		</legend>
	<?php
		echo $form->input('id');
	echo $form->input('nm_prova',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>

<?php 
//echo '<pre>';print_r($this);echo '<\pre>';
?>
	
 		
