<div class="periodicidades form">
<?php echo $form->create('Periodicidade');?>
	<fieldset>
 		<legend><?php __('Cadastrar Periodicidade');?></legend>
	<?php
		echo $form->input('periodicidade');
		echo $form->input('desc_periodicidade');
		echo $form->input('nr_dias');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
