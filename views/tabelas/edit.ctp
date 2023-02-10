<div class="tabelas form">
<?php echo $form->create('Tabela');?>
	<fieldset>
 		<legend><?php __('Edit Tabela');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('tabela');
		echo $form->input('desc_tabela');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('Tabela.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('Tabela.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
