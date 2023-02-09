<div class="militarsEscalas form">
<?php echo $form->create('MilitarsEscala');?>
	<fieldset>
 		<legend><?php __('Add MilitarsEscala');?></legend>
	<?php
		echo $form->input('escala_id');
		echo $form->input('militar_id');
		echo $form->input('codigo');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir MilitarsEscalas', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Execs Escalas', true), array('controller'=> 'execs_escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Execs Escala', true), array('controller'=> 'execs_escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
