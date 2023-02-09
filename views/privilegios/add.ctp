<div class="privilegios form">
<?php echo $form->create('Privilegio');?>
	<fieldset>
 		<legend><?php __('Cadastrar Privilegio');?></legend>
	<?php
		echo $form->input('acesso');
		echo $form->input('descricao');
		echo $form->input('Tabela');
		echo $form->input('Usuario');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Usuarios', true), array('controller'=> 'usuarios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Usuario', true), array('controller'=> 'usuarios', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
