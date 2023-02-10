<div class="tabelas form">
<?php echo $form->create('Tabela');?>
	<fieldset>
 		<legend><?php __('Add Tabela');?></legend>
	<?php
		echo $form->input('tabela');
		echo $form->input('desc_tabela');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
