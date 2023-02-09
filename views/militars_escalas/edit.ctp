<div class="militarsEscalas form">
<?php echo $form->create('MilitarsEscala');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Militares/Escala');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('escala_id');
		echo $form->input('militar_id');
		echo $form->input('codigo');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
