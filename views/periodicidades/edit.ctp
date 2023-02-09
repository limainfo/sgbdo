<div class="periodicidades form">
<?php echo $form->create('Periodicidade');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Periodicidade');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('periodicidade');
		echo $form->input('desc_periodicidade');
		echo $form->input('nr_dias');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
