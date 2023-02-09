<div class="militarsEscalas form">
<?php echo $form->create('MilitarsEscala');?>
	<fieldset>
 		<legend><?php __('Cadastrar Militares/Escala');?></legend>
	<?php
		echo $form->input('escala_id');
		echo $form->input('militar_id');
		echo $form->input('codigo');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
