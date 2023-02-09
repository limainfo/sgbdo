<div class="privilegiosTabelas form">
<?php echo $form->create('PrivilegiosTabela');?>
	<fieldset>
 		<legend><?php __('Add PrivilegiosTabela');?></legend>
	<?php
		echo $form->input('privilegio_id');
		echo $form->input('tabela_id');
		echo $form->input('dia_inicio');
		echo $form->input('dia_fim');
		echo $form->input('ver');
		echo $form->input('editar');
		echo $form->input('adicionar');
		echo $form->input('deletar');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir PrivilegiosTabelas', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('controller'=> 'privilegios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
