<div class="usuarios form">
<?php echo $form->create('Usuario');?>
	<fieldset>
 		<legend><?php __('Modificar senha do Usuario');?></legend>
	<?php
		echo $form->input('id',array('value'=>$id));
 		echo $form->input('senha',array('type'=>'password','class'=>'formulario','label'=>'Nova Senha','value'=>''));
 		echo $form->input('confirma_senha',array('type'=>'password','class'=>'formulario','value'=>''));
			?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
